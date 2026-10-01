<?php

namespace App\Services;

use App\Models\Entity;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class EntityService
{
    /** @param array<string, mixed> $data */
    public function save(Entity $entity, array $data): void
    {
        $upload = null;
        $serviceUploads = [];
        $oldServices = $entity->content['services'] ?? [];
        $previous = $entity->media;
        try {
            DB::transaction(function () use ($entity, $data, &$upload, &$serviceUploads): void {
                $entity->fill(collect($data)->except(['image', 'service_images'])->all())->save();
                $content = $entity->content ?? [];
                foreach ($data['service_images'] ?? [] as $index => $file) {
                    if (! $file instanceof UploadedFile || ! isset($content['services'][$index])) {
                        continue;
                    }
                    $path = $file->store('entities/'.$entity->id.'/services', 'public');
                    if (! $path) {
                        throw new \RuntimeException('Unable to store service image.');
                    }
                    $serviceUploads[] = $path;
                    $content['services'][$index]['image'] = '/storage/'.$path;
                }
                if ($serviceUploads) {
                    $entity->update(['content' => $content]);
                }
                if (($data['image'] ?? null) instanceof UploadedFile) {
                    $upload = MediaService::upload($data['image'], 'entities/'.$entity->id, 'Entity Image', fileable: $entity);
                    $entity->update(['media_id' => $upload->id]);
                }
            });
        } catch (Throwable $exception) {
            Storage::disk('public')->delete($serviceUploads);
            if ($upload) {
                Storage::delete($upload->src);
            }
            throw $exception;
        }

        $retained = array_column($entity->content['services'] ?? [], 'image');
        foreach ($oldServices as $service) {
            $url = $service['image'] ?? '';
            $prefix = '/storage/entities/'.$entity->id.'/services/';
            if (str_starts_with($url, $prefix) && ! in_array($url, $retained, true)
                && basename($url) === substr($url, strlen($prefix))) {
                Storage::disk('public')->delete(substr($url, strlen('/storage/')));
            }
        }

        if ($upload && $previous && $previous->fileable_type === Entity::class && $previous->fileable_id === $entity->id) {
            MediaService::delete($previous);
        }
    }

    public function delete(Entity $entity): void
    {
        $entity->delete();
    }
}
