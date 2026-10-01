<?php

namespace Tests\Feature;

use App\Models\PageContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PageContentTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_and_edit_page_without_category_and_preserve_content(): void
    {
        $this->actingAs(User::factory()->create())->post('/backend/pages', ['name' => 'About Us'])
            ->assertSessionHasNoErrors();
        $page = PageContent::firstOrFail();
        $this->assertSame('about-us', $page->page);
        $this->assertSame([], $page->content);
        $this->withoutVite()->get('/backend/pages/'.$page->id.'/edit')->assertInertia(fn (Assert $view) => $view
            ->component('Backend/PageContent/Edit')->where('pageContent.slug', 'about-us')->missing('categories'));
        $content = ['hero' => ['title_line_1' => 'About', 'trust_badges' => ['Trusted']],
            'sections' => [['title' => 'Our story', 'items' => [['title' => 'History']]]],
            'team' => [['name' => 'Alex', 'tags' => ['Director']]], 'partners' => [['name' => 'Partner']],
            'contact' => ['email' => 'hi@example.com'], 'custom' => ['keep' => true]];
        $meta = ['meta_title' => 'About us', 'primary_color' => '#2563eb'];
        $data = ['name' => 'Our Company', 'slug' => 'about-us', 'content' => json_encode($content),
            'meta' => json_encode($meta), 'is_active' => false, 'is_featured' => true, 'sort_order' => 2];
        $this->post('/backend/pages/'.$page->id, [...$data, '_method' => 'put'])
            ->assertSessionHasNoErrors()->assertRedirect('/backend/pages/'.$page->id.'/edit');
        $this->assertSame($content, $page->fresh()->content);
        $this->assertSame($meta, $page->fresh()->meta);
        $this->assertFalse($page->fresh()->is_active);
        $this->assertTrue($page->fresh()->is_featured);
        $this->put('/backend/pages/'.$page->id, [...$data, 'content' => '{}'])->assertSessionHasNoErrors();
        $this->assertSame([], $page->fresh()->content);
    }

    public function test_page_listing_search_pagination_stats_and_legacy_content(): void
    {
        $legacy = PageContent::create(['page' => 'legacy-page', 'content' => ['existing' => 'preserved']]);
        PageContent::factory()->count(12)->create(['name' => 'Company page', 'sort_order' => 1]);
        PageContent::factory()->create(['is_active' => false, 'is_featured' => true, 'sort_order' => 2]);
        PageContent::factory()->create()->delete();
        $this->actingAs(User::factory()->create())->withoutVite()->get('/backend/pages')->assertInertia(fn (Assert $view) => $view
            ->component('Backend/PageContent/Index')->has('pages.data', 12)->where('pages.total', 14)
            ->where('stats.total', 14)->where('stats.active', 13)->where('stats.inactive', 1)->where('stats.featured', 1)->missing('categories'));
        $this->get('/backend/pages?page=2')->assertInertia(fn (Assert $view) => $view->has('pages.data', 2));
        $this->get('/backend/pages?search=legacy')->assertInertia(fn (Assert $view) => $view
            ->where('pages.total', 1)->where('pages.data.0.name', 'legacy-page'));
        $this->put('/backend/pages/'.$legacy->id, ['name' => 'Legacy', 'slug' => 'legacy-page'])->assertSessionHasNoErrors();
        $this->assertSame(['existing' => 'preserved'], $legacy->fresh()->content);
    }

    public function test_page_images_status_and_soft_delete(): void
    {
        Storage::fake();
        $page = PageContent::factory()->create();
        $this->actingAs(User::factory()->create());
        $data = ['name' => $page->name, 'slug' => $page->page, '_method' => 'put'];
        $this->get('/backend/pages/'.$page->id.'/image')->assertNotFound();
        $this->post('/backend/pages/'.$page->id, [...$data, 'image' => UploadedFile::fake()->image('hero.png')])->assertSessionHasNoErrors();
        $oldImage = $page->fresh()->media;
        Storage::assertExists($oldImage->src);
        $this->get('/backend/pages/'.$page->id.'/image')->assertOk()->assertHeader('Content-Type', 'image/png');
        $this->post('/backend/pages/'.$page->id, $data)->assertSessionHasNoErrors();
        $this->assertSame($oldImage->id, $page->fresh()->media_id);
        $this->post('/backend/pages/'.$page->id, [...$data, 'image' => UploadedFile::fake()->image('new.png')])->assertSessionHasNoErrors();
        Storage::assertMissing($oldImage->src);
        $image = $page->fresh()->media;
        $this->from('/backend/pages')->patch('/backend/pages/'.$page->id.'/active')->assertRedirect('/backend/pages');
        $this->assertFalse($page->fresh()->is_active);
        $this->delete('/backend/pages/'.$page->id)->assertRedirect('/backend/pages');
        $this->assertSoftDeleted($page);
        Storage::assertExists($image->src);
        $this->get('/backend/pages/'.$page->id.'/edit')->assertNotFound();
    }

    public function test_invalid_page_data_is_rejected(): void
    {
        Storage::fake();
        $page = PageContent::factory()->create();
        $this->actingAs(User::factory()->create())->post('/backend/pages', [
            'name' => '', 'slug' => $page->page, 'content' => '{broken', 'meta' => 'bad',
            'is_active' => 'bad', 'sort_order' => -1,
            'image' => UploadedFile::fake()->create('bad.svg', 10, 'image/svg+xml'),
        ])->assertSessionHasErrors(['name', 'slug', 'content', 'meta', 'is_active', 'sort_order', 'image']);
        $this->post('/backend/pages', ['name' => 'Test', 'content' => ['sections' => 'bad'],
            'image' => UploadedFile::fake()->image('large.png')->size(5121)])
            ->assertSessionHasErrors(['content.sections', 'image']);
        $this->assertDatabaseCount('page_contents', 1);
        $this->assertSame([], Storage::allFiles());
    }

    public function test_guests_and_missing_pages_are_protected(): void
    {
        $page = PageContent::factory()->create();
        $this->get('/backend/pages')->assertRedirect('/login');
        $this->get('/backend/pages/'.$page->id.'/edit')->assertRedirect('/login');
        $this->get('/backend/pages/'.$page->id.'/image')->assertRedirect('/login');
        $this->post('/backend/pages', [])->assertRedirect('/login');
        $this->put('/backend/pages/'.$page->id, [])->assertRedirect('/login');
        $this->patch('/backend/pages/'.$page->id.'/active')->assertRedirect('/login');
        $this->delete('/backend/pages/'.$page->id)->assertRedirect('/login');
        $this->assertNotSoftDeleted($page);
        $this->actingAs(User::factory()->create())->get('/backend/pages/99999/edit')->assertNotFound();
    }
}
