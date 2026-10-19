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
        $previous = $entity->media;
        try {
            DB::transaction(function () use ($entity, $data, &$upload): void {
                $meta = $entity->meta ?? [];
                foreach (['short_description', 'link'] as $field) {
                    if (array_key_exists($field, $data)) {
                        $meta[$field] = $data[$field];
                    }
                }
                $entity->fill(collect($data)->only(['name', 'slug', 'category', 'sort_order'])->all());
                $entity->meta = $meta;
                $entity->save();
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
        $entity->delete();
    }
}
