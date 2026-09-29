<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class NewsCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_can_be_created_updated_listed_and_deleted(): void
    {
        $this->actingAs(User::factory()->create());
        $this->post('/backend/news-category', ['name' => 'Technology', 'slug' => 'technology', 'is_active' => true])
            ->assertSessionHasNoErrors()->assertRedirect('/backend/news-category');
        $this->assertDatabaseHas('news_categories', ['name' => 'Technology', 'slug' => 'technology']);
        $category = NewsCategory::firstOrFail();
        $this->put('/backend/news-category/'.$category->id, ['name' => 'Tech', 'slug' => 'technology', 'is_active' => false])
            ->assertSessionHasNoErrors()->assertRedirect('/backend/news-category');
        $this->withoutVite()->get('/backend/news-category')->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('Backend/NewsCategory/Index')
                ->has('categories', 1)->where('categories.0.name', 'Tech')
                ->where('categories.0.is_active', false)->where('categories.0.articles_count', 0));
        $this->delete('/backend/news-category/'.$category->id)->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('news_categories', ['id' => $category->id]);
    }

    public function test_guests_cannot_manage_categories(): void
    {
        $this->get('/backend/news-category')->assertRedirect('/login');
        $this->post('/backend/news-category', [])->assertRedirect('/login');
        $this->put('/backend/news-category/1', [])->assertRedirect('/login');
        $this->delete('/backend/news-category/1')->assertRedirect('/login');
    }

    public function test_article_counts_are_displayed_without_parent_categories(): void
    {
        $category = NewsCategory::factory()->create();
        News::factory()->create(['news_category_id' => $category->id]);
        $this->actingAs(User::factory()->create())->withoutVite()->get('/backend/news-category')
            ->assertInertia(fn (Assert $page) => $page
                ->where('categories.0.articles_count', 1)
                ->missing('categories.0.parent')->missing('categories.0.parent_id'));
    }

    public function test_invalid_fields_and_duplicate_slugs_are_rejected(): void
    {
        $category = NewsCategory::factory()->create();
        $this->actingAs(User::factory()->create())->post('/backend/news-category', [
            'name' => '', 'slug' => $category->slug, 'is_active' => 'invalid',
        ])->assertSessionHasErrors(['name', 'slug', 'is_active']);
        $this->post('/backend/news-category', [
            'name' => '!!!', 'slug' => 'ignored', 'is_active' => true,
        ])->assertSessionHasErrors('slug');
        $this->assertDatabaseCount('news_categories', 1);
    }

    public function test_categories_with_articles_cannot_be_deleted(): void
    {
        $category = NewsCategory::factory()->create();
        $article = News::factory()->create(['news_category_id' => $category->id]);
        $this->actingAs(User::factory()->create())->delete('/backend/news-category/'.$category->id)
            ->assertSessionHasErrors('category');
        $this->assertDatabaseCount('news_categories', 1);
        $this->assertSame($category->id, $article->fresh()->news_category_id);
    }

    public function test_updating_to_an_existing_slug_does_not_change_the_category(): void
    {
        $category = NewsCategory::factory()->create();
        $other = NewsCategory::factory()->create(['name' => 'Sport Entertainment', 'slug' => 'sport_entertainment']);
        $this->actingAs(User::factory()->create())->put('/backend/news-category/'.$category->id, [
            'name' => $other->name, 'slug' => 'ignored', 'is_active' => false,
        ])->assertSessionHasErrors('slug');
        $this->assertSame($category->name, $category->fresh()->name);
    }

    public function test_slugs_are_generated_from_names_on_create_and_update(): void
    {
        $this->actingAs(User::factory()->create())->post('/backend/news-category', [
            'name' => 'Sport', 'is_active' => true,
        ])->assertSessionHasNoErrors();
        $category = NewsCategory::firstOrFail();
        $this->assertSame('sport', $category->slug);
        $this->put('/backend/news-category/'.$category->id, [
            'name' => '  Sport   Entertainment News  ', 'slug' => 'tampered', 'is_active' => true,
        ])->assertSessionHasNoErrors();
        $this->assertSame('sport_entertainment_news', $category->fresh()->slug);
        $this->post('/backend/news-category', [
            'name' => 'Sport Entertainment News', 'is_active' => true,
        ])->assertSessionHasErrors('slug');
        $this->assertDatabaseCount('news_categories', 1);
    }
}
