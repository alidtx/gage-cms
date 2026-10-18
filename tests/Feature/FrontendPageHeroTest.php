<?php

namespace Tests\Feature;

use App\Models\PageContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FrontendPageHeroTest extends TestCase
{
    use RefreshDatabase;

    public function test_pages_render_matching_active_hero_and_fall_back_when_inactive(): void
    {
        foreach (['home', 'about', 'contact', 'news', 'gage_project_client', 'gage_security', 'gage_fire_safety', 'gage_training_instruction', 'gage_technology'] as $slug) {
            $path = $slug === 'home' ? '/' : '/'.str_replace('_', '-', $slug);
            $page = PageContent::factory()->create(['page' => $slug, 'content' => ['hero' => ['title_line_1' => "Managed $slug", 'title_highlight' => 'Obsolete highlight', 'subtitle' => 'Managed description', 'primary_cta' => ['text' => 'Managed button', 'href' => '/contact']]]]);
            $this->get($path)->assertOk()->assertSee("Managed $slug")->assertSee('Managed description')->assertSee('Managed button')->assertDontSee('Obsolete highlight');
            $page->update(['is_active' => false]);
            $this->get($path)->assertOk()->assertDontSee("Managed $slug");
        }
    }

    public function test_only_home_renders_video_and_unsafe_buttons_are_omitted(): void
    {
        Storage::fake('public');
        foreach (['home' => '/', 'about' => '/about'] as $slug => $path) {
            $page = PageContent::factory()->create(['page' => $slug]);
            $video = "pages/{$page->id}/hero-videos/intro.mp4";
            Storage::disk('public')->put($video, 'video');
            $page->update(['content' => ['hero' => ['title_line_1' => 'Managed title', 'video_url' => '/storage/'.$video, 'primary_cta' => ['text' => 'Unsafe button', 'href' => 'javascript:alert(1)']]]]);
            $response = $this->get($path)->assertOk()->assertDontSee('Unsafe button');
            if ($slug === 'home') {
                $response->assertSee('/storage/'.$video, false);
            } else {
                $response->assertDontSee('/storage/'.$video, false);
            }
        }
    }

    public function test_uploaded_images_are_public_only_for_active_pages(): void
    {
        Storage::fake();
        $page = PageContent::factory()->create(['page' => 'about']);
        $this->actingAs(User::factory()->create())->post('/backend/pages/'.$page->id, [
            '_method' => 'put', 'name' => $page->name, 'slug' => 'about',
            'image' => UploadedFile::fake()->image('hero.png'),
            'content' => ['hero' => ['image_alt' => 'Our team']],
        ])->assertSessionHasNoErrors();
        auth()->forgetGuards();
        $url = route('frontend.page-hero-image', $page);
        $this->get('/about')->assertOk()->assertSee($url, false)->assertSee('Our team');
        $this->get($url)->assertOk()->assertHeader('Content-Type', 'image/png');
        $page->update(['is_active' => false]);
        $this->get($url)->assertNotFound();
        $page->delete();
        $this->get($url)->assertNotFound();
    }

    public function test_legacy_hyphenated_slugs_still_resolve(): void
    {
        PageContent::factory()->create(['page' => 'gage-fire-safety', 'content' => ['hero' => ['title_line_1' => 'Legacy fire hero']]]);
        $this->get('/gage-fire-safety')->assertOk()->assertSee('Legacy fire hero');
    }
}
