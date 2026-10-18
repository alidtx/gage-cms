<?php

namespace App\Services;

use App\Models\PageContent;
use Illuminate\Support\Facades\Storage;

class FrontendHero
{
    /** @return array<string, mixed> */
    public function forPage(string $slug): array
    {
        $defaults = [];
        $page = PageContent::with('media')->where('page', str_replace('-', '_', $slug))->where('is_active', true)->first()
            ?? PageContent::with('media')->where('page', str_replace('_', '-', $slug))->where('is_active', true)->first();
        if (! $page) {
            return $defaults;
        }
        $content = data_get($page->content, 'hero', []);
        $text = static fn (mixed $value): string => is_string($value) ? trim(strip_tags($value)) : '';
        $title = $text(data_get($content, 'title_line_1'));
        if ($title !== '') {
            $defaults['heading'] = [['text' => $title]];
        }
        foreach (['subtitle' => 'description', 'badge.text' => 'eyebrow'] as $source => $target) {
            if (data_get($content, $source) !== null) {
                $defaults[$target] = $text(data_get($content, $source));
            }
        }
        $buttons = $defaults['buttons'] ?? [];
        foreach (['primary_cta', 'secondary_cta'] as $index => $key) {
            if (data_get($content, $key) === null) {
                continue;
            }
            $label = $text(data_get($content, "$key.text"));
            $href = $text(data_get($content, "$key.href"));
            $defaults['buttons'][$index] = null;
            if ($label !== '' && preg_match('~^(?:/(?!/)|#[\w-]*$|https?://|mailto:|tel:)~i', $href) && ! preg_match('/[\x00-\x20\\\\]/', $href)) {
                $defaults['buttons'][$index] = array_merge($buttons[$index] ?? [], ['label' => $label, 'url' => $href]);
            }
        }
        if ($page->media && $page->media->fileable_type === PageContent::class && (int) $page->media->fileable_id === $page->id && Storage::exists($page->media->src)) {
            $defaults['image'] = [
                'src' => route('frontend.page-hero-image', $page),
                'alt' => $text(data_get($content, 'image_alt')) ?: $page->name,
            ];
        }
        $video = data_get($content, 'video_url');
        if ($slug === 'home' && is_string($video) && str_starts_with($video, "/storage/pages/{$page->id}/hero-videos/") && ! str_contains($video, '..') && Storage::disk('public')->exists(substr($video, 9))) {
            $defaults['video'] = $video;
        }

        return $defaults;
    }

    /**
     * Merge supplied content with template styling without loading data.
     *
     * @param  array<string, mixed>  $defaults
     * @param  array<string, mixed>  $content
     * @return array<string, mixed>
     */
    public static function merge(array $defaults, array $content): array
    {
        if (isset($content['image'])) {
            unset($defaults['image']['width'], $defaults['image']['height']);
            $content['image'] = array_replace($defaults['image'] ?? [], $content['image']);
        }
        if (array_key_exists('buttons', $content)) {
            $buttons = $defaults['buttons'] ?? [];
            foreach ($content['buttons'] as $index => $button) {
                if ($button === null) {
                    unset($buttons[$index]);
                } else {
                    $buttons[$index] = array_replace($buttons[$index] ?? [], $button);
                }
            }
            ksort($buttons);
            $content['buttons'] = array_values($buttons);
        }

        return array_replace($defaults, $content);
    }
}
