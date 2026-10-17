<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendAboutTest extends TestCase
{
    use RefreshDatabase;

    public function test_about_design_renders_with_shared_layout_seo_and_local_assets(): void
    {
        $response = $this->get('/about')->assertOk()->assertViewIs('frontend.pages.about')
            ->assertSee('<title>About GAGE | Experts in Safety &amp; Security</title>', false)
            ->assertSee('rel="canonical" href="'.url('/about').'"', false)
            ->assertSee('aria-current="page"', false)
            ->assertDontSee('.html"', false)->assertDontSee('./public/', false);
        $html = $response->getContent();
        $this->assertSame(1, substr_count($html, '<h1 '));
        $this->assertSame(1, substr_count($html, '<main '));
        preg_match_all('/src="'.preg_quote(url('/'), '/').'\/(assets\/[^"]+)"/', $html, $assets);
        $this->assertNotEmpty($assets[1]);
        foreach ($assets[1] as $path) {
            $this->assertFileExists(public_path($path));
        }
        $this->get('/')->assertSee('href="'.route('frontend.about').'"', false);
    }
}
