<?php

namespace Tests\Feature;

use App\Models\BasicSeo;
use App\Models\GlobalSetting;
use App\Models\User;
use App\Services\MediaService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FrontendSeoTest extends TestCase
{
    use RefreshDatabase;

    public function test_global_defaults_and_basic_home_overrides_are_rendered(): void
    {
        GlobalSetting::create(['site_name' => 'GAGE Global', 'site_description' => 'Global description', 'author' => 'Editorial team', 'twitter_site' => '@gage', 'facebook_app_id' => '123']);
        $this->get('/')->assertOk()->assertSee('<title>GAGE Global</title>', false)
            ->assertSee('content="Global description"', false)->assertSee('content="@gage"', false);
        $basic = BasicSeo::create(['title' => 'Home title', 'meta_description' => 'Home description', 'og_title' => 'Social title', 'twitter_title' => 'Twitter title', 'canonical_url' => 'https://gage.example/', 'schema_type' => 'WebSite']);
        $this->get('/?tracking=1')->assertOk()->assertSee('<title>Home title</title>', false)
            ->assertSee('content="Social title"', false)->assertSee('content="Twitter title"', false)
            ->assertSee('rel="canonical" href="https://gage.example/"', false)->assertSee('"@type":"WebSite"', false);

        $this->actingAs(User::factory()->create())->put(route('backend.basic-seo.update', $basic), ['title' => 'Updated home'])->assertSessionHasNoErrors();
        $this->get('/')->assertSee('<title>Updated home</title>', false);
    }

    public function test_schema_and_metadata_cannot_inject_scripts_and_invalid_tracking_is_ignored(): void
    {
        $payload = '</script><script>alert(1)</script>';
        GlobalSetting::create(['google_analytics_id' => $payload, 'google_tag_manager_id' => $payload]);
        BasicSeo::create(['title' => $payload, 'canonical_url' => 'javascript:alert(1)', 'custom_schema' => ['@context' => 'https://schema.org', '@type' => 'Organization', 'name' => $payload]]);
        $response = $this->get('/?utm_source=test')->assertOk()->assertDontSee($payload, false)
            ->assertSee('rel="canonical" href="'.url('/').'"', false)->assertDontSee('googletagmanager.com', false);
        preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $response->getContent(), $match);
        $this->assertSame($payload, json_decode($match[1], true, flags: JSON_THROW_ON_ERROR)['name']);
    }

    public function test_public_social_images_use_fallbacks_and_deny_unrelated_media(): void
    {
        Storage::fake();
        $global = GlobalSetting::create(['site_name' => 'GAGE']);
        $old = MediaService::upload(UploadedFile::fake()->image('old.png'), 'seo', 'Default OG Image', fileable: $global);
        $og = MediaService::upload(UploadedFile::fake()->image('og.png'), 'seo', 'Default OG Image', fileable: $global);
        $twitter = MediaService::upload(UploadedFile::fake()->image('twitter.png'), 'seo', 'Default Twitter Image', fileable: $global);
        $private = MediaService::upload(UploadedFile::fake()->image('private.png'), 'private', 'Private document', fileable: $global);
        $this->get('/')->assertSee('property="og:image" content="'.route('frontend.seo-image', $og).'"', false)
            ->assertSee('name="twitter:image" content="'.route('frontend.seo-image', $twitter).'"', false)
            ->assertDontSee(route('frontend.seo-image', $old), false);
        $this->get(route('frontend.seo-image', $og))->assertOk()->assertHeader('Content-Type', 'image/png');
        $this->get(route('frontend.seo-image', $private))->assertNotFound();

        $basic = BasicSeo::create(['title' => 'Home']);
        $share = MediaService::upload(UploadedFile::fake()->image('share.png'), 'seo', 'Social Share Image', fileable: $basic);
        $this->get('/')->assertSee('property="og:image" content="'.route('frontend.seo-image', $share).'"', false);
        Storage::delete($share->src);
        $this->get(route('frontend.seo-image', $share))->assertNotFound();
        $this->get('/')->assertSee('property="og:image" content="'.route('frontend.seo-image', $og).'"', false);
    }

    public function test_tracking_uses_gtm_instead_of_duplicate_ga_installation(): void
    {
        $global = GlobalSetting::create(['google_analytics_id' => 'G-ABC123']);
        $this->get('/')->assertSee('gtag/js?id=G-ABC123', false);
        $global->update(['google_tag_manager_id' => 'GTM-ABC123']);
        $this->get('/')->assertSee('ns.html?id=GTM-ABC123', false)->assertDontSee('gtag/js?id=', false);
    }
}
