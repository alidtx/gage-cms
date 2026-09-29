<?php

namespace App\Services;

use App\Models\Entity;
use App\Models\Media;
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
        $previous = $entity->media;
        try {
            DB::transaction(function () use ($entity, $data, &$upload): void {
                $entity->fill(collect($data)->except('image')->all())->save();
                if (($data['image'] ?? null) instanceof UploadedFile) {
                    $upload = MediaService::upload($data['image'], 'entities/'.$entity->id, 'Entity Image', fileable: $entity);
                    $entity->update(['media_id' => $upload->id]);
                }
            });
        } catch (Throwable $exception) {
            if ($upload) {
                Storage::delete($upload->src);
            }
            throw $exception;
        }

        if ($upload && $previous && $previous->fileable_type === Entity::class && $previous->fileable_id === $entity->id) {
            MediaService::delete($previous);
        }
    }

    public function delete(Entity $entity): void
    {
        $images = Media::where('fileable_type', Entity::class)->where('fileable_id', $entity->id)->get();
        DB::transaction(function () use ($entity, $images): void {
            $entity->delete();
            foreach ($images as $image) {
                $image->delete();
            }
        });
        foreach ($images as $image) {
            Storage::delete($image->src);
        }
    }
}
