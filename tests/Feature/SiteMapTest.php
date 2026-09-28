<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class SiteMapTest extends TestCase
{
    use RefreshDatabase;

    public function test_settings_page_displays_real_counts_and_defaults(): void
    {
        $this->withoutVite()->actingAs(User::factory()->create())
            ->get('/backend/sitemap')->assertOk()
            ->assertInertia(fn (Assert $page) => $page
                ->component('Backend/SiteMap/Index')
                ->has('settings', 5)
                ->where('stats.total', 1)
                ->where('stats.included', 1)
                ->where('stats.excluded', 0));
    }

    public function test_saving_settings_changes_public_xml_and_survives_reload(): void
    {
        $this->get('/sitemap.xml')->assertOk();
        $this->actingAs(User::factory()->create())
            ->put('/backend/sitemap', ['settings' => [[
                'content_type' => 'Static Pages', 'include' => true,
                'priority' => '0.3', 'change_frequency' => 'daily',
            ]]])->assertSessionHasNoErrors()->assertRedirect('/backend/sitemap');
        $this->assertDatabaseHas('site_maps', [
            'content_type' => 'Static Pages', 'priority' => '0.3', 'change_frequency' => 'daily',
        ]);
        $xml = $this->get('/sitemap.xml')->assertOk()->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $document = simplexml_load_string($xml->getContent());
        $this->assertSame('0.3', (string) $document->url->priority);
        $this->assertSame('daily', (string) $document->url->changefreq);
        $this->assertSame(rtrim(config('app.url'), '/').'/', (string) $document->url->loc);

        $this->put('/backend/sitemap', ['settings' => [[
            'content_type' => 'Static Pages', 'include' => false,
            'priority' => '0.3', 'change_frequency' => 'daily',
        ]]])->assertSessionHasNoErrors();
        $document = simplexml_load_string($this->get('/sitemap.xml')->getContent());
        $this->assertCount(0, $document->url);
        $this->withoutVite()->get('/backend/sitemap')->assertInertia(fn (Assert $page) => $page
            ->where('settings.4.include', false)->where('stats.included', 0)->where('stats.excluded', 1));
    }

    public function test_invalid_settings_are_rejected_without_partial_updates(): void
    {
        $this->actingAs(User::factory()->create())->put('/backend/sitemap', ['settings' => [
            ['content_type' => 'Static Pages', 'include' => true, 'priority' => '0.8', 'change_frequency' => 'weekly'],
            ['content_type' => 'Unknown', 'include' => 'invalid', 'priority' => 2, 'change_frequency' => 'sometimes'],
        ]])->assertSessionHasErrors(['settings.1.content_type', 'settings.1.include', 'settings.1.priority', 'settings.1.change_frequency']);
        $this->assertDatabaseCount('site_maps', 0);
    }

    public function test_regeneration_saves_pending_changes_and_rebuilds_xml(): void
    {
        $this->get('/sitemap.xml')->assertOk();
        $this->actingAs(User::factory()->create())->post('/backend/sitemap/regenerate', ['settings' => [[
            'content_type' => 'Static Pages', 'include' => false, 'priority' => '0.8', 'change_frequency' => 'weekly',
        ]]])->assertSessionHasNoErrors()->assertRedirect('/backend/sitemap');
        $this->assertCount(0, simplexml_load_string($this->get('/sitemap.xml')->getContent())->url);
        $this->assertDatabaseHas('site_maps', ['content_type' => 'Static Pages', 'include' => false]);
    }

    public function test_guests_cannot_manage_settings_but_can_read_xml(): void
    {
        $this->get('/backend/sitemap')->assertRedirect('/login');
        $this->put('/backend/sitemap', [])->assertRedirect('/login');
        $this->post('/backend/sitemap/regenerate', [])->assertRedirect('/login');
        $xml = $this->get('/sitemap.xml')->assertOk()->getContent();
        $this->assertStringNotContainsString('/backend', $xml);
        $this->assertStringNotContainsString('/login', $xml);
    }
}
