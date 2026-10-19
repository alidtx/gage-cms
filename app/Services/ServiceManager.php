<?php

namespace App\Services;

use App\Models\Media;
use App\Models\Service;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ServiceManager
{
    /** @param array<string, mixed> $data */
    public function save(Service $service, array $data): void
    {
        $previous = $service->media;
        $upload = null;
        try {
            DB::transaction(function () use ($service, $data, &$upload): void {
                $service->fill(collect($data)->only(['title', 'description', 'entity_id'])->all())->save();
                if (($data['icon'] ?? null) instanceof UploadedFile) {
                    $upload = MediaService::upload($data['icon'], 'services/'.$service->id, 'Service SVG Icon', fileable: $service);
                    $upload->update(['type' => 'image']);
                    $service->update(['media_id' => $upload->id, 'icon' => null]);
                }
            });
        } catch (Throwable $exception) {
            if ($upload) {
                Storage::delete($upload->src);
            }
            throw $exception;
        }
        if ($upload && $previous && $previous->fileable_type === Service::class && $previous->fileable_id === $service->id) {
            MediaService::delete($previous);
        }
    }

    public function delete(Service $service): void
    {
        $images = Media::where('fileable_type', Service::class)->where('fileable_id', $service->id)->get();
        DB::transaction(function () use ($service, $images): void {
            $service->delete();
            foreach ($images as $image) {
                $image->delete();
            }
        });
        foreach ($images as $image) {
            Storage::delete($image->src);
        }
    }
}
