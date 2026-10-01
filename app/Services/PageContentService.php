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
        $previous = $pageContent->media;
        try {
            DB::transaction(function () use ($pageContent, $data, &$upload): void {
                $pageContent->fill(collect($data)->except('image')->all())->save();
                if (($data['image'] ?? null) instanceof UploadedFile) {
                    $upload = MediaService::upload($data['image'], 'pages/'.$pageContent->id, 'PageContent Image', fileable: $pageContent);
                    $pageContent->update(['media_id' => $upload->id]);
                }
            });
        } catch (Throwable $exception) {
            if ($upload) {
                Storage::delete($upload->src);
            }
            throw $exception;
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
