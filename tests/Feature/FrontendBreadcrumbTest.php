<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendBreadcrumbTest extends TestCase
{
    use RefreshDatabase;

    public function test_inner_pages_have_accessible_breadcrumbs_and_matching_schema(): void
    {
        foreach (['about', 'contact', 'news', 'gage-security', 'gage-fire-safety', 'gage-training-instruction', 'gage-technology', 'gage-project-client'] as $path) {
            $html = $this->get('/'.$path.'?source=test')->assertOk()->getContent();
            preg_match('/<nav aria-label="Breadcrumb".*?<\/nav>/s', $html, $nav);
            $this->assertNotEmpty($nav);
            $this->assertStringContainsString('aria-current="page"', $nav[0]);
            $this->assertStringContainsString('href="'.route('frontend.home').'"', $nav[0]);
            $this->assertStringNotContainsString('.html', $nav[0]);
            preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $scripts);
            $schemas = array_map(fn ($json) => json_decode($json, true, flags: JSON_THROW_ON_ERROR), $scripts[1]);
            $breadcrumbs = array_values(array_filter($schemas, fn ($schema) => ($schema['@type'] ?? '') === 'BreadcrumbList'));
            $this->assertCount(1, $breadcrumbs);
            $trail = $breadcrumbs[0]['itemListElement'];
            $this->assertSame(url('/'.$path), end($trail)['item']);
            $this->assertSame(range(1, count($trail)), array_column($trail, 'position'));
            if (in_array($path, ['gage-security', 'gage-fire-safety', 'gage-training-instruction', 'gage-technology'], true)) {
                $this->assertSame(route('frontend.home').'#companies', $trail[1]['item']);
            }
        }
    }
}
