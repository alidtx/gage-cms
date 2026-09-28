<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSiteMapRequest;
use App\Services\SiteMapService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class SiteMapController extends Controller
{
    public function index(SiteMapService $sitemap): InertiaResponse
    {
        $settings = $sitemap->settings();
        $total = $settings->sum('page_count');
        $included = $settings->where('include', true)->sum('page_count');

        return Inertia::render('Backend/SiteMap/Index', [
            'settings' => $settings,
            'stats' => ['total' => $total, 'included' => $included, 'excluded' => $total - $included, 'files' => 1],
            'generatedAt' => $sitemap->document()['generated_at'],
            'sitemapUrl' => route('sitemap.xml', [], false),
            'success' => session('success'),
        ]);
    }

    public function update(UpdateSiteMapRequest $request, SiteMapService $sitemap): RedirectResponse
    {
        $sitemap->save($request->validated('settings'));
        $sitemap->regenerate();

        return to_route('backend.sitemap.index')->with('success', 'Sitemap settings saved and XML regenerated.');
    }

    public function regenerate(UpdateSiteMapRequest $request, SiteMapService $sitemap): RedirectResponse
    {
        return $this->update($request, $sitemap);
    }

    public function xml(SiteMapService $sitemap): Response
    {
        return response($sitemap->document()['xml'], 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'no-cache',
        ]);
    }
}
