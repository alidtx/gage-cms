<?php

namespace App\Services;

use App\Models\BasicSeo;
use App\Models\GlobalSetting;
use App\Models\Media;
use App\Models\PageContent;
use Illuminate\Support\Facades\Storage;

class FrontendSeo
{
    /** @param array<string, mixed> $defaults
     * @return array<string, mixed>
     */
    public function forPage(string $slug, array $defaults = []): array
    {
        $page = PageContent::where('page', str_replace('-', '_', $slug))->where('is_active', true)->first()
            ?? PageContent::where('page', str_replace('_', '-', $slug))->where('is_active', true)->first();
        foreach (['meta_title' => 'title', 'meta_description' => 'description', 'meta_keywords' => 'keywords'] as $field => $key) {
            $value = data_get($page?->meta, $field);
            if (is_string($value) && trim($value) !== '') {
                $defaults[$key] = trim($value);
                if ($key === 'title' || $key === 'description') {
                    $defaults['og_'.$key] = trim($value);
                    $defaults['twitter_'.$key] = trim($value);
                }
            }
        }

        return $defaults;
    }

    /** @param array<string, mixed> $overrides
     * @return array<string, mixed>
     */
    public function resolve(array $overrides = []): array
    {
        $global = GlobalSetting::with(['defaultOgImage', 'defaultTwitterImage'])->orderBy('id')->first();
        $basic = request()->routeIs('frontend.home')
            ? BasicSeo::with('seoImage')->orderBy('id')->first()
            : null;
        $siteName = $global?->site_name ?: 'GAGE';
        $title = $overrides['title'] ?? ($basic?->title ?: ($global?->site_name ?: 'GAGE | Experts in Safety & Security'));
        $description = $overrides['description'] ?? ($basic?->meta_description ?: ($global?->site_description ?: 'Security, fire safety, training and technology across the Maldives from GAGE.'));
        $canonical = $overrides['canonical'] ?? $basic?->canonical_url;
        if (! is_string($canonical) || ! filter_var($canonical, FILTER_VALIDATE_URL) || ! in_array(parse_url($canonical, PHP_URL_SCHEME), ['http', 'https'], true)) {
            $canonical = url()->current();
        }
        $shareImage = $this->imageUrl($basic?->seoImage);
        $ogImage = $shareImage ?: ($this->imageUrl($global?->defaultOgImage) ?: asset('assets/pdf-1.jpg'));
        $twitterImage = $shareImage ?: ($this->imageUrl($global?->defaultTwitterImage) ?: $ogImage);
        $schema = $basic?->custom_schema;
        if (is_string($schema)) {
            $schema = json_decode($schema, true);
        }
        if (! is_array($schema) || $schema === []) {
            $schema = [
                '@context' => 'https://schema.org',
                '@type' => $basic?->schema_type ?: 'Organization',
                'name' => $siteName,
                'url' => $canonical,
                'description' => $description,
            ];
        }
        $gtm = $this->trackingId($global?->google_tag_manager_id, '/\AGTM-[A-Z0-9]+\z/');
        $ga = $this->trackingId($global?->google_analytics_id, '/\AG-[A-Z0-9]+\z/');

        return [
            'title' => $title, 'description' => $description, 'canonical' => $canonical,
            'site_name' => $siteName, 'keywords' => $overrides['keywords'] ?? ($basic?->keywords ?: $global?->site_keywords),
            'author' => $global?->author, 'publisher' => $global?->publisher,
            'facebook_app_id' => $global?->facebook_app_id, 'twitter_site' => $global?->twitter_site,
            'og_title' => $overrides['og_title'] ?? ($basic?->og_title ?: $title),
            'og_description' => $overrides['og_description'] ?? ($basic?->og_description ?: $description),
            'og_type' => $basic?->og_type ?: 'website', 'og_image' => $ogImage,
            'twitter_title' => $overrides['twitter_title'] ?? ($basic?->twitter_title ?: $title),
            'twitter_description' => $overrides['twitter_description'] ?? ($basic?->twitter_description ?: $description),
            'twitter_card' => $basic?->twitter_card_type ?: 'summary_large_image',
            'twitter_image' => $twitterImage, 'schema' => $overrides['schema'] ?? $schema,
            'gtm' => $gtm, 'ga' => $gtm ? null : $ga,
        ];
    }

    private function imageUrl(?Media $media): ?string
    {
        return $media && Storage::exists($media->src)
            ? route('frontend.seo-image', $media)
            : null;
    }

    private function trackingId(?string $value, string $pattern): ?string
    {
        return $value && preg_match($pattern, $value) ? $value : null;
    }
}
