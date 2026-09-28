<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBasicSeoRequest;
use App\Models\BasicSeo;

class BasicSeoController extends Controller
{
    public function index()
    {
        $basicSeo = BasicSeo::with('media')->firstOrCreate([], [
            'title'             => 'Digital Marketing Services - Grow Your Business Online',
            'meta_description'  => 'We provide expert digital marketing services including SEO, PPC, social media, and content marketing.',
            'og_type'           => 'website',
            'twitter_card_type' => 'summary_large_image',
            'schema_type'       => 'Service',
        ]);

        return inertia('Backend/BasicSeo/Index', [
            'basicSeo' => $basicSeo,
        ]);
    }

    public function update(UpdateBasicSeoRequest $request, BasicSeo $basicSeo)
    {
        $data = $request->validated();

        if (!empty($data['custom_schema']) && is_string($data['custom_schema'])) {
            $decoded = json_decode($data['custom_schema'], true);
            $data['custom_schema'] = json_last_error() === JSON_ERROR_NONE ? $decoded : null;
        }

        $basicSeo->update($data);

        return redirect()
            ->route('backend.basic-seo.index')
            ->with('success', 'SEO settings updated successfully.');
    }
}