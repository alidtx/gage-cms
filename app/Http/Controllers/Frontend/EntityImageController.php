<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Entity;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class EntityImageController extends Controller
{
    public function __invoke(Entity $entity): StreamedResponse
    {
        $media = $entity->media;
        abort_unless($entity->is_active && $media && $media->fileable_type === Entity::class && (int) $media->fileable_id === $entity->id && Storage::exists($media->src), 404);
        $mime = Storage::mimeType($media->src);
        abort_unless(in_array($mime, ['image/jpeg', 'image/png', 'image/webp', 'image/gif'], true), 404);

        return Storage::response($media->src, null, ['Content-Type' => $mime, 'X-Content-Type-Options' => 'nosniff', 'Cache-Control' => 'no-cache']);
    }
}
