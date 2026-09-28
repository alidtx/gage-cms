<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateGlobalSettingRequest;
use App\Models\GlobalSetting;
use App\Services\MediaService;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\StreamedResponse;

class GlobalSettingController extends Controller
{
    public function index()
    {
        $globalSetting = GlobalSetting::firstOrCreate([], [
            'site_name' => 'Your Company Name',
            'site_description' => 'Delivering excellence in services across multiple industries with a commitment to quality and innovation.',
            'site_keywords' => 'services, innovation, quality, industry leader',
            'author' => 'Your Company',
            'publisher' => 'Your Company',
        ]);

        $globalSetting->load(['defaultOgImage', 'defaultTwitterImage']);

        return Inertia::render('Backend/GlobalSeo/Index', [
            'globalSetting' => [
                ...$globalSetting->toArray(),
                'default_og_image_url' => $globalSetting->defaultOgImage
                    ? route('backend.global-settings.image', [$globalSetting, 'og'], false)
                    : null,
                'default_twitter_image_url' => $globalSetting->defaultTwitterImage
                    ? route('backend.global-settings.image', [$globalSetting, 'twitter'], false)
                    : null,
            ],
        ]);
    }

    public function image(GlobalSetting $globalSetting, string $type): StreamedResponse
    {
        $media = match ($type) {
            'og' => $globalSetting->defaultOgImage,
            'twitter' => $globalSetting->defaultTwitterImage,
            default => null,
        };

        abort_unless($media && Storage::exists($media->src), 404);

        return Storage::response($media->src, null, [
            'Cache-Control' => 'no-store, private',
        ]);
    }

    public function update(UpdateGlobalSettingRequest $request, GlobalSetting $globalSetting)
    {
        $data = $request->validated();

        unset($data['default_og_image'], $data['default_twitter_image']);

        if ($request->hasFile('default_og_image')) {
            MediaService::deleteByName($globalSetting, 'Default OG Image');

            MediaService::upload(
                file: $request->file('default_og_image'),
                path: 'seo/global/og-images',
                name: 'Default OG Image',
                fileable: $globalSetting,
            );
        }

        if ($request->hasFile('default_twitter_image')) {
            MediaService::deleteByName($globalSetting, 'Default Twitter Image');

            MediaService::upload(
                file: $request->file('default_twitter_image'),
                path: 'seo/global/twitter-images',
                name: 'Default Twitter Image',
                fileable: $globalSetting,
            );
        }

        $globalSetting->update($data);

        return redirect()
            ->route('backend.global-settings.index')
            ->with('success', 'Global settings updated successfully.');
    }
}