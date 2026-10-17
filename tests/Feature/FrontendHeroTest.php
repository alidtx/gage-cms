<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendHeroTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_pages_render_one_hero_with_expected_optional_elements(): void
    {
        foreach (['/' => 'Protecting', '/about' => 'Maldives', '/contact' => 'talk', '/news' => 'News', '/gage-security' => 'Dependable', '/gage-fire-safety' => 'Protecting', '/gage-training-instruction' => 'Building', '/gage-technology' => 'Connected', '/gage-project-client' => 'Protecting'] as $path => $heading) {
            $html = $this->get($path)->assertOk()->getContent();
            preg_match('/<main[^>]*>\s*(<section.*?<\/section>)/s', $html, $matches);
            $this->assertNotEmpty($matches);
            $hero = $matches[1];
            $this->assertSame(1, substr_count($hero, '<h1 '));
            $this->assertStringContainsString($heading, $hero);
            $this->assertStringNotContainsString('./public/', $hero);
            $this->assertStringNotContainsString('.html', $hero);
            if (in_array($path, ['/contact', '/news', '/gage-project-client'], true)) {
                $this->assertStringNotContainsString('<img ', $hero);
            } else {
                $this->assertStringContainsString('fetchpriority="high"', $hero);
            }
            if ($path !== '/') {
                $this->assertStringContainsString('aria-label="Breadcrumb"', $hero);
            }
        }
    }

    public function test_component_escapes_text_and_supports_minimal_configuration(): void
    {
        $this->view('frontend.components.hero', ['hero' => ['heading' => [['text' => '<script>alert(1)</script>']]]])
            ->assertSee('&lt;script&gt;', false)->assertDontSee('<script>alert', false);
    }
}
