<?php

namespace Tests\Feature;

use Tests\TestCase;

class FrontendHomeTest extends TestCase
{
    public function test_home_renders_blade_content_and_seo_metadata(): void
    {
        $response = $this->get('/?utm_source=test');

        $response->assertOk()->assertViewIs('frontend.pages.home')
            ->assertSee('Protecting', false)
            ->assertSee('name="description"', false)
            ->assertSee('property="og:image"', false)
            ->assertSee('name="twitter:card"', false)
            ->assertSee('application/ld+json', false)
            ->assertSee('href="'.url('/').'"', false)
            ->assertDontSee('data-page=', false)
            ->assertDontSee('./public/assets/', false)
            ->assertDontSee('.html"', false);
        $this->assertSame(1, substr_count($response->getContent(), '<h1 '));
        $this->assertSame(1, substr_count($response->getContent(), '<main '));
        preg_match('/<link rel="canonical" href="([^"]+)"/', $response->getContent(), $canonical);
        $this->assertSame(url('/'), $canonical[1]);
        preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $response->getContent(), $schema);
        $this->assertSame('Organization', json_decode($schema[1], true, flags: JSON_THROW_ON_ERROR)['@type']);
    }

    public function test_home_assets_and_section_links_exist(): void
    {
        $html = $this->get('/')->assertOk()->getContent();
        preg_match_all('/(?:src|href)="'.preg_quote(url('/'), '/').'\/(assets\/[^"]+|styles\.css[^"]*|frontend\.(?:css|js)[^"]*)"/', $html, $assets);
        $this->assertNotEmpty($assets[1]);
        foreach ($assets[1] as $asset) {
            $this->assertFileExists(public_path(explode('?', $asset)[0]));
        }
        preg_match_all('/href="'.preg_quote(url('/'), '/').'#([^"]+)"/', $html, $anchors);
        foreach ($anchors[1] as $anchor) {
            $this->assertStringContainsString('id="'.$anchor.'"', $html);
        }
        $this->get('/frontend')->assertStatus(301)->assertRedirect('/');
        $this->get('/dashboard')->assertRedirect('/login');
    }
}
