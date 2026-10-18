<?php

namespace App\Services;

use App\Models\PageContent;
use Illuminate\Support\Facades\Storage;

class FrontendHero
{
    /** @param array<string, mixed> $defaults
     * @return array<string, mixed>
     */
    public function resolve(?string $route, array $defaults): array
    {
        $slug = match ($route) {
            'frontend.home' => 'home',
            'frontend.about' => 'about',
            'contact.create' => 'contact',
            'frontend.news' => 'news',
            'frontend.gage-project-client' => 'gage-project-client',
            'frontend.gage-security' => 'gage-security',
            'frontend.gage-fire-safety' => 'gage-fire-safety',
            'frontend.gage-training-instruction' => 'gage-training-instruction',
            'frontend.gage-technology' => 'gage-technology',
            default => null,
        };
        if ($slug === null) {
            return $defaults;
        }
        $page = PageContent::with('media')->where('page', str_replace('-', '_', $slug))->where('is_active', true)->first()
            ?? PageContent::with('media')->where('page', $slug)->where('is_active', true)->first();
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
            unset($defaults['buttons'][$index]);
            if ($label !== '' && preg_match('~^(?:/(?!/)|#[\w-]*$|https?://|mailto:|tel:)~i', $href) && ! preg_match('/[\x00-\x20\\\\]/', $href)) {
                $defaults['buttons'][$index] = array_merge($buttons[$index] ?? [], ['label' => $label, 'url' => $href]);
            }
        }
        $badges = data_get($content, 'trust_badges', []);
        $defaults['trust_badges'] = is_array($badges) ? array_values(array_filter(array_map($text, $badges))) : [];
        if ($page->media && $page->media->fileable_type === PageContent::class && (int) $page->media->fileable_id === $page->id && Storage::exists($page->media->src)) {
            $defaults['image'] = [
                'src' => route('frontend.page-hero-image', $page),
                'alt' => $text(data_get($content, 'image_alt')) ?: $page->name,
                'class' => $defaults['image']['class'] ?? 'aspect-[1.05] w-full rounded-[16px] object-cover',
            ];
        }
        $video = data_get($content, 'video_url');
        if ($slug === 'home' && is_string($video) && str_starts_with($video, "/storage/pages/{$page->id}/hero-videos/") && ! str_contains($video, '..') && Storage::disk('public')->exists(substr($video, 9))) {
            $defaults['video'] = $video;
        }

        return $defaults;
    }
}
