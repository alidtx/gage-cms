<?php

namespace App\Services;

use App\Models\SiteMap;
use DOMDocument;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class SiteMapService
{
    public const DEFAULTS = [
        'Services' => ['priority' => '0.6', 'change_frequency' => 'weekly'],
        'Projects' => ['priority' => '0.4', 'change_frequency' => 'monthly'],
        'News & Insights' => ['priority' => '0.7', 'change_frequency' => 'daily'],
        'Careers' => ['priority' => '1.0', 'change_frequency' => 'monthly'],
        'Static Pages' => ['priority' => '0.8', 'change_frequency' => 'weekly'],
    ];

    public function settings(): Collection
    {
        $saved = SiteMap::query()->orderBy('id')->get()->keyBy('content_type');

        return collect(self::DEFAULTS)->map(function (array $defaults, string $type) use ($saved) {
            $setting = $saved->get($type);

            return [
                'content_type' => $type,
                'include' => $setting?->include ?? true,
                'priority' => $setting?->priority ?? $defaults['priority'],
                'change_frequency' => $setting?->change_frequency ?? $defaults['change_frequency'],
                'page_count' => count(config('sitemap.pages', [])[$type] ?? []),
            ];
        })->values();
    }

    public function save(array $settings): void
    {
        DB::transaction(function () use ($settings) {
            foreach ($settings as $setting) {
                SiteMap::query()->updateOrCreate(
                    ['content_type' => $setting['content_type']],
                    collect($setting)->only(['include', 'priority', 'change_frequency'])->all(),
                );
            }
        });
    }

    public function generate(): array
    {
        $document = new DOMDocument('1.0', 'UTF-8');
        $document->formatOutput = true;
        $root = $document->createElementNS('http://www.sitemaps.org/schemas/sitemap/0.9', 'urlset');
        $document->appendChild($root);
        $seen = [];

        foreach ($this->settings()->where('include', true) as $setting) {
            foreach (config('sitemap.pages', [])[$setting['content_type']] ?? [] as $path) {
                $location = rtrim(config('app.url'), '/').'/'.ltrim($path, '/');
                if (isset($seen[$location])) {
                    continue;
                }
                $seen[$location] = true;
                $url = $document->createElement('url');
                foreach (['loc' => $location, 'changefreq' => $setting['change_frequency'], 'priority' => $setting['priority']] as $name => $value) {
                    $element = $document->createElement($name);
                    $element->appendChild($document->createTextNode((string) $value));
                    $url->appendChild($element);
                }
                $root->appendChild($url);
            }
        }

        return ['xml' => $document->saveXML(), 'generated_at' => now()->toIso8601String()];
    }

    public function document(): array
    {
        return Cache::remember($this->cacheKey(), 3600, fn () => $this->generate());
    }

    public function regenerate(): void
    {
        Cache::put($this->cacheKey(), $this->generate(), 3600);
    }

    private function cacheKey(): string
    {
        return 'sitemap:'.sha1(config('app.url').json_encode(config('sitemap.pages')));
    }
}
