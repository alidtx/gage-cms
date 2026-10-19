<?php

namespace Tests\Feature;

use App\Models\SocialLink;
use App\Services\FrontendSocialLinks;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendSocialLinksTest extends TestCase
{
    use RefreshDatabase;

    public function test_footer_uses_configured_social_links_and_hides_unsafe_links(): void
    {
        SocialLink::create(['facebook' => 'https://facebook.com/example', 'youtube' => 'https://youtube.com/@example', 'whatsapp' => 'https://wa.me/9601234567', 'instagram' => 'javascript:alert(1)']);
        $this->get('/')->assertOk()->assertSee('https://facebook.com/example', false)->assertSee('https://youtube.com/@example', false)->assertSee('https://wa.me/9601234567', false)->assertDontSee('javascript:alert(1)', false)->assertDontSee('https://www.linkedin.com/company/gage-private-limited/', false)->assertSee('noopener noreferrer', false);
    }

    public function test_component_supports_light_theme_and_size_without_querying(): void
    {
        $links = ['facebook' => ['label' => 'Facebook', 'url' => 'https://facebook.com/example']];
        $this->view('frontend.components.social-links', ['links' => $links, 'theme' => 'light', 'size' => 24])->assertSee('width="24"', false)->assertSee('#f0f1f3', false);
        $this->view('frontend.components.social-links', ['links' => []])->assertDontSee('<nav', false);
    }

    public function test_settings_are_loaded_once_for_repeated_component_use(): void
    {
        SocialLink::create(['facebook' => 'https://facebook.com/example']);
        $service = app(FrontendSocialLinks::class);
        $this->assertSame('https://facebook.com/example', $service->all()['facebook']['url']);
        $this->expectsDatabaseQueryCount(0);
        $this->assertSame($service->all(), app(FrontendSocialLinks::class)->all());
    }
}
