<?php

namespace Tests\Feature;

use App\Models\Media;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FrontendNewsTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_shows_only_three_latest_public_articles(): void
    {
        $category = NewsCategory::factory()->create();
        $older = News::factory()->create(['news_category_id' => $category->id, 'status' => 'published', 'published_at' => now()->subDays(10), 'is_featured' => true]);
        $recent = collect([3, 2, 1])->map(fn ($days) => News::factory()->create(['news_category_id' => $category->id, 'status' => 'published', 'published_at' => now()->subDays($days)]));
        $draft = News::factory()->create(['news_category_id' => $category->id, 'status' => 'draft']);
        $future = News::factory()->create(['news_category_id' => $category->id, 'status' => 'published', 'published_at' => now()->addDay()]);
        $response = $this->get('/')->assertOk();
        $this->assertSame($recent->reverse()->pluck('id')->values()->all(), $response->viewData('recentNews')->pluck('id')->all());
        $response->assertDontSee($older->title)->assertDontSee($draft->title)->assertDontSee($future->title)
            ->assertSee(route('frontend.news.show', $recent->last()->slug), false);
    }

    public function test_local_publication_time_is_visible_without_publishing_future_articles_early(): void
    {
        $this->travelTo(Carbon::parse('2026-10-18 08:53:00', 'UTC'));
        $category = NewsCategory::factory()->create();
        $published = News::factory()->create(['title' => 'Local published story', 'news_category_id' => $category->id, 'status' => 'published', 'published_at' => '2026-10-18 13:38:00']);
        $future = News::factory()->create(['title' => 'Future local story', 'news_category_id' => $category->id, 'status' => 'published', 'published_at' => '2026-10-18 14:00:00']);

        $this->get(route('frontend.news', ['category' => $category->slug]))->assertOk()
            ->assertSee($published->title)->assertDontSee($future->title);
        $this->get(route('frontend.news.show', $published->slug))->assertOk();
        $this->get(route('frontend.news.show', $future->slug))->assertNotFound();
    }

    public function test_latest_featured_story_is_separate_from_the_paginated_category_grid(): void
    {
        $category = NewsCategory::factory()->create();
        $older = News::factory()->create(['news_category_id' => $category->id, 'status' => 'published', 'published_at' => now()->subDays(3), 'is_featured' => true]);
        $latest = News::factory()->create(['news_category_id' => $category->id, 'status' => 'published', 'published_at' => now()->subDay(), 'is_featured' => true]);
        News::factory()->count(7)->create(['news_category_id' => $category->id, 'status' => 'published', 'published_at' => now()->subDays(2), 'is_featured' => false]);
        News::factory()->create(['news_category_id' => NewsCategory::factory()->create()->id, 'status' => 'published', 'published_at' => now(), 'is_featured' => true]);
        foreach ([1, 2] as $page) {
            $response = $this->get(route('frontend.news', ['category' => $category->slug, 'page' => $page]))->assertOk();
            $this->assertSame($latest->id, $response->viewData('featuredArticle')->id);
            $this->assertFalse($response->viewData('articles')->getCollection()->contains('id', $latest->id));
            $this->assertSame(8, $response->viewData('articles')->total());
        }
        $this->assertTrue($response->viewData('articles')->getCollection()->contains('id', $older->id));
    }

    public function test_categories_filter_published_articles_and_pagination_keeps_filter(): void
    {
        $category = NewsCategory::factory()->create(['name' => 'Technology']);
        News::factory()->count(8)->create(['news_category_id' => $category->id, 'status' => 'published', 'published_at' => now()->subDay()]);
        $other = News::factory()->create(['title' => 'Other category story', 'news_category_id' => NewsCategory::factory()->create()->id, 'status' => 'published', 'published_at' => now()->subDay()]);
        $this->get(route('frontend.news', ['category' => $category->slug]))->assertOk()
            ->assertSee('Technology')->assertDontSee($other->title)
            ->assertSee('category='.$category->slug, false)->assertSee('page=2', false);
        $this->get(route('frontend.news', ['category' => 'missing']))->assertNotFound();
    }

    public function test_unpublished_articles_and_inactive_categories_are_not_public(): void
    {
        $category = NewsCategory::factory()->create();
        foreach (['draft', 'archived', 'future', 'undated', 'inactive'] as $state) {
            $article = News::factory()->create([
                'title' => 'Hidden '.$state,
                'news_category_id' => $state === 'inactive' ? NewsCategory::factory()->create(['is_active' => false])->id : $category->id,
                'status' => in_array($state, ['draft', 'archived']) ? $state : 'published',
                'published_at' => $state === 'undated' ? null : ($state === 'future' ? now()->addDay() : now()->subDay()),
            ]);
            $this->get('/news')->assertOk()->assertDontSee($article->title);
            $this->get(route('frontend.news.show', $article->slug))->assertNotFound();
            $this->get(route('frontend.news.image', [$article->slug, 'featured']))->assertNotFound();
        }
    }

    public function test_article_content_is_formatted_without_executable_html(): void
    {
        $article = News::factory()->create([
            'news_category_id' => NewsCategory::factory()->create()->id,
            'status' => 'published', 'published_at' => now()->subDay(),
            'content' => '<h1>Story heading</h1><p><span>Intro</span><strong>Welcome</strong><script>alert(1)</script><img src="/storage/photo.jpg" onerror="alert(2)"><a href="javascript:alert(3)">Unsafe</a></p>',
            'meta_title' => 'Article SEO title',
        ]);
        $this->get(route('frontend.news.show', $article->slug))->assertOk()
            ->assertSee('<h2>Story heading</h2>', false)->assertSee('<span>Intro</span>', false)->assertSee('<strong>Welcome</strong>', false)->assertSee('Article SEO title')
            ->assertDontSee('alert(1)', false)->assertDontSee('onerror', false)->assertDontSee('javascript:', false);
    }

    public function test_public_image_is_served_only_for_its_published_owner(): void
    {
        Storage::fake('local');
        Storage::put('news/test.png', base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+aV1sAAAAASUVORK5CYII='));
        $article = News::factory()->create(['news_category_id' => NewsCategory::factory()->create()->id, 'status' => 'published', 'published_at' => now()->subDay()]);
        $media = Media::create(['name' => 'Featured Image', 'src' => 'news/test.png', 'fileable_type' => News::class, 'fileable_id' => $article->id]);
        $article->update(['featured_image_id' => $media->id]);
        $this->get(route('frontend.news.image', [$article->slug, 'featured']))->assertOk()->assertHeader('Content-Type', 'image/png');
        $article->update(['status' => 'draft']);
        $this->get(route('frontend.news.image', [$article->slug, 'featured']))->assertNotFound();
    }

    public function test_empty_category_has_a_clear_empty_state(): void
    {
        $category = NewsCategory::factory()->create();
        $this->get(route('frontend.news', ['category' => $category->slug]))->assertOk()->assertSee('No published news');
    }
}
