<?php

namespace Tests\Feature;

use App\Models\BasicSeo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class BasicSeoTest extends TestCase
{
    use RefreshDatabase;

    public function test_saved_previews_survive_reload_and_text_only_updates(): void
    {
        Storage::fake('local');
        config(['filesystems.default' => 'local']);
        $this->withoutVite()->actingAs(User::factory()->create());
        $seo = BasicSeo::create(['title' => 'Original']);
        $image = UploadedFile::fake()->image('social.png');
        $contents = file_get_contents($image->getRealPath());

        $this->post(route('backend.basic-seo.update', $seo), [
            '_method' => 'PUT',
            'title' => 'Saved search title',
            'meta_description' => 'Saved search description',
            'og_title' => 'Saved social title',
            'og_description' => 'Saved social description',
            'canonical_url' => 'https://example.com/services',
            'social_share_image' => $image,
        ])->assertSessionHasNoErrors()->assertRedirect(route('backend.basic-seo.index'));

        $media = $seo->fresh()->seoImage;
        $this->assertNotNull($media);
        Storage::disk('local')->assertExists($media->src);

        $response = $this->get(route('backend.basic-seo.index'));
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Backend/BasicSeo/Index')
            ->where('basicSeo.title', 'Saved search title')
            ->where('basicSeo.meta_description', 'Saved search description')
            ->where('basicSeo.og_title', 'Saved social title')
            ->where('basicSeo.og_description', 'Saved social description')
            ->where('basicSeo.canonical_url', 'https://example.com/services')
            ->has('basicSeo.social_share_image')
        );
        $url = $response->inertiaProps('basicSeo.social_share_image');
        $this->get($url)->assertOk()->assertHeader('Content-Type', 'image/png')
            ->assertStreamedContent($contents);

        $this->put(route('backend.basic-seo.update', $seo), [
            'title' => 'Updated search title',
            'social_share_image' => null,
        ])->assertSessionHasNoErrors()->assertRedirect(route('backend.basic-seo.index'));

        $this->get(route('backend.basic-seo.index'))->assertInertia(fn (Assert $page) => $page
            ->where('basicSeo.title', 'Updated search title')
            ->where('basicSeo.media_id', $media->id)
            ->where('basicSeo.social_share_image', $url)
        );
        $this->get($url)->assertOk()->assertStreamedContent($contents);
    }

    public function test_image_preview_requires_authentication(): void
    {
        $seo = BasicSeo::create(['title' => 'SEO']);

        $this->get("/backend/basic-seo/{$seo->id}/image")
            ->assertRedirect(route('login'));
    }

    public function test_replacing_the_image_serves_the_new_upload_and_handles_a_missing_file(): void
    {
        Storage::fake('local');
        config(['filesystems.default' => 'local']);
        $this->actingAs(User::factory()->create());
        $seo = BasicSeo::create(['title' => 'SEO']);
        $this->post(route('backend.basic-seo.update', $seo), [
            '_method' => 'PUT',
            'social_share_image' => UploadedFile::fake()->image('first.png'),
        ])->assertSessionHasNoErrors();
        $oldMedia = $seo->fresh()->seoImage;
        $replacement = UploadedFile::fake()->image('replacement.png', 20, 20);
        $contents = file_get_contents($replacement->getRealPath());

        $this->post(route('backend.basic-seo.update', $seo), [
            '_method' => 'PUT',
            'social_share_image' => $replacement,
        ])->assertSessionHasNoErrors()->assertRedirect(route('backend.basic-seo.index'));

        $media = $seo->fresh()->seoImage;
        Storage::disk('local')->assertMissing($oldMedia->src);
        $this->assertModelMissing($oldMedia);
        $this->get("/backend/basic-seo/{$seo->id}/image")
            ->assertOk()->assertHeader('Cache-Control', 'no-store, private')
            ->assertStreamedContent($contents);

        Storage::disk('local')->delete($media->src);
        $this->get("/backend/basic-seo/{$seo->id}/image")->assertNotFound();
    }

    public function test_image_preview_returns_404_when_no_image_is_attached(): void
    {
        $seo = BasicSeo::create(['title' => 'SEO']);

        $this->actingAs(User::factory()->create())
            ->get("/backend/basic-seo/{$seo->id}/image")
            ->assertNotFound();
    }
}
