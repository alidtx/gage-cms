<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ServiceIconController extends Controller
{
    public function __invoke(Service $service): StreamedResponse
    {
        $media = $service->media;
        abort_unless($service->entity?->is_active && $media && $media->name === 'Service SVG Icon' && $media->fileable_type === Service::class && (int) $media->fileable_id === $service->id && Storage::exists($media->src), 404);

        return Storage::response($media->src, null, ['Content-Type' => 'image/svg+xml', 'X-Content-Type-Options' => 'nosniff', 'Content-Security-Policy' => "default-src 'none'; sandbox", 'Cache-Control' => 'no-cache']);
    }
}
