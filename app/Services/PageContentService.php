<?php

namespace App\Services;

use App\Models\PageContent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class PageContentService
{
    /** @param array<string, mixed> $data */
    public function save(PageContent $pageContent, array $data): void
    {
        $data['page'] = $data['slug'];
        unset($data['slug']);
        $data['content'] ??= $pageContent->content ?? [];
        $upload = null;
        $videoPath = null;
        $oldVideo = $pageContent->content['hero']['video_url'] ?? null;
        $previous = $pageContent->media;
        try {
            DB::transaction(function () use ($pageContent, $data, &$upload, &$videoPath, $oldVideo): void {
                $pageContent->fill(collect($data)->except(['image', 'hero_video', 'remove_hero_video'])->all())->save();
                $content = $pageContent->content ?? [];
                if (($data['hero_video'] ?? null) instanceof UploadedFile) {
                    $videoPath = $data['hero_video']->store('pages/'.$pageContent->id.'/hero-videos', 'public');
                    if (! $videoPath) {
                        throw new \RuntimeException('Unable to store the hero video.');
                    }
                    $content['hero']['video_url'] = '/storage/'.$videoPath;
                } elseif ($data['remove_hero_video'] ?? false) {
                    unset($content['hero']['video_url']);
                } elseif ($oldVideo) {
                    $content['hero']['video_url'] = $oldVideo;
                }
                $pageContent->update(['content' => $content]);
                if (($data['image'] ?? null) instanceof UploadedFile) {
                    $upload = MediaService::upload($data['image'], 'pages/'.$pageContent->id, 'PageContent Image', fileable: $pageContent);
                    $pageContent->update(['media_id' => $upload->id]);
                }
            });
        } catch (Throwable $exception) {
            if ($videoPath) {
                Storage::disk('public')->delete($videoPath);
            }
            if ($upload) {
                Storage::delete($upload->src);
            }
            throw $exception;
        }

        $prefix = '/storage/pages/'.$pageContent->id.'/hero-videos/';
        if (is_string($oldVideo) && ($videoPath || ($data['remove_hero_video'] ?? false))
            && str_starts_with($oldVideo, $prefix) && basename($oldVideo) === substr($oldVideo, strlen($prefix))) {
            Storage::disk('public')->delete(substr($oldVideo, strlen('/storage/')));
        }

        if ($upload && $previous && $previous->fileable_type === PageContent::class && $previous->fileable_id === $pageContent->id) {
            MediaService::delete($previous);
        }
    }

    public function delete(PageContent $pageContent): void
    {
        $pageContent->delete();
    }
}
