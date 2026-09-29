<?php

namespace Tests\Feature;

use App\Models\Media;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    private function articleData(array $overrides = []): array
    {
        return array_replace([
            'title' => 'Company Expands', 'slug' => 'company-expands',
            'news_category_id' => NewsCategory::factory()->create()->id,
            'content' => '<p>Our latest news.</p>', 'excerpt' => 'A short summary.',
            'status' => 'draft', 'is_featured' => false,
        ], $overrides);
    }

    public function test_news_can_be_created_edited_and_deleted(): void
    {
        $user = User::factory()->create();
        $data = $this->articleData(['author_id' => $user->id, 'meta_title' => 'SEO title',
            'meta_description' => 'SEO summary', 'canonical_url' => 'https://example.com/news/company']);
        $this->actingAs($user)->post('/backend/news', $data)->assertSessionHasNoErrors()->assertRedirect('/backend/news');
        $article = News::firstOrFail();
        $this->assertDatabaseHas('news', $data);
        $this->withoutVite()->get('/backend/news/'.$article->id.'/edit')->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('Backend/News/Index')->where('article.id', $article->id));
        $this->put('/backend/news/'.$article->id, array_replace($data, [
            'title' => 'Updated news', 'status' => 'published', 'published_at' => '2026-09-29T12:30', 'is_featured' => true,
        ]))->assertSessionHasNoErrors()->assertRedirect('/backend/news');
        $this->assertDatabaseHas('news', ['id' => $article->id, 'title' => 'Updated news', 'status' => 'published', 'is_featured' => true]);
        $this->delete('/backend/news/'.$article->id)->assertSessionHasNoErrors()->assertRedirect('/backend/news');
        $this->assertDatabaseMissing('news', ['id' => $article->id]);
    }

    public function test_news_list_supports_search_filters_and_pagination(): void
    {
        $user = User::factory()->create();
        $category = NewsCategory::factory()->create();
        News::factory()->count(12)->create(['title' => 'Market update', 'news_category_id' => $category->id,
            'author_id' => $user->id, 'status' => 'published', 'is_featured' => true]);
        News::factory()->create(['title' => 'Other story', 'status' => 'draft']);
        $this->actingAs($user)->withoutVite()->get('/backend/news?search=Market&status=published&featured=1&category='.$category->id)
            ->assertInertia(fn (Assert $page) => $page->component('Backend/News/Index')
                ->has('articles.data', 10)->where('articles.total', 12)
                ->where('articles.data.0.category.name', $category->name)
                ->where('articles.data.0.author.name', $user->name));
        $this->get('/backend/news?search=Market&page=2')->assertInertia(fn (Assert $page) => $page
            ->has('articles.data', 2)->where('articles.current_page', 2));
        $this->get('/backend/news?search=missing')->assertInertia(fn (Assert $page) => $page->has('articles.data', 0));
        $this->get('/backend/news?status=draft&featured=0')->assertInertia(fn (Assert $page) => $page->where('articles.total', 1));
    }

    public function test_invalid_news_is_rejected_without_saving(): void
    {
        $existing = News::factory()->create(['slug' => 'duplicate']);
        $this->actingAs(User::factory()->create())->post('/backend/news', [
            'title' => '', 'slug' => $existing->slug, 'news_category_id' => 9999, 'author_id' => 9999,
            'content' => '', 'status' => 'invalid', 'is_featured' => 'invalid',
            'published_at' => 'invalid', 'canonical_url' => 'javascript:alert(1)',
            'featured_image' => UploadedFile::fake()->create('bad.pdf', 10, 'application/pdf'),
            'og_image' => UploadedFile::fake()->create('bad.svg', 10, 'image/svg+xml'),
        ])->assertSessionHasErrors(['title', 'slug', 'news_category_id', 'author_id', 'content', 'status',
            'is_featured', 'published_at', 'canonical_url', 'featured_image', 'og_image']);
        $this->assertDatabaseCount('news', 1);
        $this->post('/backend/news', $this->articleData(['status' => 'published']))->assertSessionHasErrors('published_at');
    }

    public function test_images_are_preserved_replaced_and_cleaned_up(): void
    {
        Storage::fake();
        $data = $this->articleData();
        $this->actingAs(User::factory()->create())->post('/backend/news', array_replace($data, [
            'featured_image' => UploadedFile::fake()->image('featured.jpg'),
            'og_image' => UploadedFile::fake()->image('social.png'),
        ]))->assertSessionHasNoErrors();
        $article = News::firstOrFail();
        $oldImage = Media::findOrFail($article->featured_image_id);
        $ogImage = Media::findOrFail($article->og_image_id);
        Storage::assertExists([$oldImage->src, $ogImage->src]);
        $this->get('/backend/news/'.$article->id.'/image/featured')->assertOk()->assertHeader('Content-Type', 'image/jpeg');
        $this->get('/backend/news/'.$article->id.'/image/invalid')->assertNotFound();
        $this->put('/backend/news/'.$article->id, $data)->assertSessionHasNoErrors();
        $this->assertSame($oldImage->id, $article->fresh()->featured_image_id);
        $this->post('/backend/news/'.$article->id, array_replace($data, [
            '_method' => 'put', 'featured_image' => UploadedFile::fake()->image('replacement.png'),
        ]))->assertSessionHasNoErrors();
        Storage::assertMissing($oldImage->src);
        $replacement = Media::findOrFail($article->fresh()->featured_image_id);
        $this->assertSame($ogImage->id, $article->fresh()->og_image_id);
        $this->delete('/backend/news/'.$article->id)->assertSessionHasNoErrors();
        Storage::assertMissing([$replacement->src, $ogImage->src]);
        $this->assertDatabaseCount('media', 0);
    }

    public function test_guests_cannot_access_news_management(): void
    {
        $article = News::factory()->create();
        $this->get('/backend/news')->assertRedirect('/login');
        $this->get('/backend/news/'.$article->id.'/edit')->assertRedirect('/login');
        $this->get('/backend/news/'.$article->id.'/image/featured')->assertRedirect('/login');
        $this->post('/backend/news', [])->assertRedirect('/login');
        $this->put('/backend/news/'.$article->id, [])->assertRedirect('/login');
        $this->delete('/backend/news/'.$article->id)->assertRedirect('/login');
        $this->assertDatabaseHas('news', ['id' => $article->id]);
    }
}
