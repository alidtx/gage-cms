<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BasicSeo;
use App\Models\GlobalSetting;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SeoImageController extends Controller
{
    public function __invoke(Media $media): StreamedResponse
    {
        $allowed = match ($media->fileable_type) {
            BasicSeo::class => $media->name === 'Social Share Image' && BasicSeo::whereKey($media->fileable_id)->exists(),
            GlobalSetting::class => in_array($media->name, ['Default OG Image', 'Default Twitter Image'], true) && GlobalSetting::whereKey($media->fileable_id)->exists(),
            default => false,
        };
        abort_unless($allowed && Storage::exists($media->src), 404);
        $mime = Storage::mimeType($media->src);
        abort_unless(in_array($mime, ['image/jpeg', 'image/png', 'image/webp', 'image/gif'], true), 404);

        return Storage::response($media->src, null, [
            'Content-Type' => $mime,
            'X-Content-Type-Options' => 'nosniff',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
