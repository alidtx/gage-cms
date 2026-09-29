<?php

namespace App\Services;

use App\Models\Media;
use App\Models\News;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class NewsService
{
    /** @param array<string, mixed> $data */
    public function save(News $news, array $data): void
    {
        $uploads = [];
        $oldImages = [];
        try {
            DB::transaction(function () use ($news, $data, &$uploads, &$oldImages): void {
                $news->fill(collect($data)->except(['featured_image', 'og_image'])->all());
                $news->save();
                foreach (['featured_image' => 'Featured Image', 'og_image' => 'OG Image'] as $field => $name) {
                    $file = $data[$field] ?? null;
                    if (! $file instanceof UploadedFile) {
                        continue;
                    }
                    $column = $field.'_id';
                    $oldImages[] = Media::find($news->{$column});
                    $media = MediaService::upload($file, 'news/'.$news->id, $name, fileable: $news);
                    $uploads[] = $media->src;
                    $news->{$column} = $media->id;
                }
                $news->save();
            });
        } catch (Throwable $exception) {
            foreach ($uploads as $path) {
                Storage::delete($path);
            }
            throw $exception;
        }

        foreach ($oldImages as $media) {
            if ($media && $media->fileable_type === News::class && $media->fileable_id === $news->id) {
                MediaService::delete($media);
            }
        }
    }

    public function delete(News $news): void
    {
        $images = Media::where('fileable_type', News::class)->where('fileable_id', $news->id)->get();
        DB::transaction(function () use ($news, $images): void {
            $news->delete();
            foreach ($images as $image) {
                $image->delete();
            }
        });
        foreach ($images as $image) {
            Storage::delete($image->src);
        }
    }
}
