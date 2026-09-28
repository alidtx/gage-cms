<?php

// app/Http/Controllers/Backend/BasicSeoController.php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBasicSeoRequest;
use App\Models\BasicSeo;
use App\Services\MediaService;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BasicSeoController extends Controller
{
    public function index()
    {
        $basicSeo = BasicSeo::with('seoImage')->firstOrCreate([], [
            'title' => 'Digital Marketing Services - Grow Your Business Online',
            'meta_description' => 'We provide expert digital marketing services including SEO, PPC, social media, and content marketing.',
            'og_type' => 'website',
            'twitter_card_type' => 'summary_large_image',
            'schema_type' => 'Service',
        ]);

        return inertia('Backend/BasicSeo/Index', [
            'basicSeo' => [
                ...$basicSeo->toArray(),
                'social_share_image' => $basicSeo->seoImage
                    ? route('backend.basic-seo.image', $basicSeo, false)
                    : null,
            ],
        ]);
    }

    public function image(BasicSeo $basicSeo): StreamedResponse
    {
        $media = $basicSeo->seoImage;

        abort_unless($media && Storage::exists($media->src), 404);

        return Storage::response($media->src, null, [
            'Cache-Control' => 'no-store, private',
        ]);
    }

    public function update(UpdateBasicSeoRequest $request, BasicSeo $basicSeo)
    {
        $data = $request->validated();

        unset($data['social_share_image']);

        if (! empty($data['custom_schema']) && is_string($data['custom_schema'])) {
            $decoded = json_decode($data['custom_schema'], true);
            $data['custom_schema'] = json_last_error() === JSON_ERROR_NONE
                ? $decoded
                : null;
        }

        if ($request->hasFile('social_share_image')) {

            MediaService::deleteByName($basicSeo, 'Social Share Image');

            $media = MediaService::upload(
                file: $request->file('social_share_image'),
                path: 'seo/social-share-images',
                name: 'Social Share Image',
                fileable: $basicSeo,
            );

            if ($media) {
                $data['media_id'] = $media->id;
            }
        }

        $basicSeo->update($data);

        return redirect()
            ->route('backend.basic-seo.index')
            ->with('success', 'SEO settings updated successfully.');
    }
}
