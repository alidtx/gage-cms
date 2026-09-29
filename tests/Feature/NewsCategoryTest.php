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
        $this->put('/backend/news-category/'.$category->id, ['name' => 'Tech', 'slug' => 'technology', 'is_active' => false, 'parent_id' => null])
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

    public function test_parent_relationship_and_article_counts_are_displayed(): void
    {
        $parent = NewsCategory::factory()->create(['name' => 'Technology']);
        $this->actingAs(User::factory()->create())->post('/backend/news-category', [
            'name' => 'AI', 'slug' => 'ai', 'parent_id' => $parent->id, 'is_active' => true,
        ])->assertSessionHasNoErrors();
        $child = NewsCategory::where('slug', 'ai')->firstOrFail();
        News::factory()->create(['news_category_id' => $child->id]);
        $this->withoutVite()->get('/backend/news-category')->assertInertia(fn (Assert $page) => $page
            ->where('categories.0.parent.name', 'Technology')->where('categories.0.articles_count', 1));
    }

    public function test_invalid_fields_and_duplicate_slugs_are_rejected(): void
    {
        $category = NewsCategory::factory()->create();
        $this->actingAs(User::factory()->create())->post('/backend/news-category', [
            'name' => '', 'slug' => $category->slug, 'parent_id' => 9999, 'is_active' => 'invalid',
        ])->assertSessionHasErrors(['name', 'slug', 'parent_id', 'is_active']);
        $this->post('/backend/news-category', [
            'name' => 'News', 'slug' => 'Bad Slug!', 'is_active' => true,
        ])->assertSessionHasErrors('slug');
        $this->assertDatabaseCount('news_categories', 1);
    }

    public function test_self_and_descendant_parents_are_rejected(): void
    {
        $parent = NewsCategory::factory()->create();
        $child = NewsCategory::factory()->create(['parent_id' => $parent->id]);
        $grandchild = NewsCategory::factory()->create(['parent_id' => $child->id]);
        $this->actingAs(User::factory()->create());
        foreach ([$parent->id, $grandchild->id] as $parentId) {
            $this->put('/backend/news-category/'.$parent->id, [
                'name' => $parent->name, 'slug' => $parent->slug, 'parent_id' => $parentId, 'is_active' => true,
            ])->assertSessionHasErrors('parent_id');
        }
        $this->assertNull($parent->fresh()->parent_id);
    }

    public function test_categories_with_children_or_articles_cannot_be_deleted(): void
    {
        $parent = NewsCategory::factory()->create();
        $child = NewsCategory::factory()->create(['parent_id' => $parent->id]);
        $article = News::factory()->create(['news_category_id' => $child->id]);
        $this->actingAs(User::factory()->create())->delete('/backend/news-category/'.$parent->id)
            ->assertSessionHasErrors('category');
        $this->delete('/backend/news-category/'.$child->id)->assertSessionHasErrors('category');
        $this->assertDatabaseCount('news_categories', 2);
        $this->assertSame($child->id, $article->fresh()->news_category_id);
    }

    public function test_updating_to_an_existing_slug_does_not_change_the_category(): void
    {
        $category = NewsCategory::factory()->create();
        $other = NewsCategory::factory()->create();
        $this->actingAs(User::factory()->create())->put('/backend/news-category/'.$category->id, [
            'name' => 'Changed', 'slug' => $other->slug, 'is_active' => false,
        ])->assertSessionHasErrors('slug');
        $this->assertSame($category->name, $category->fresh()->name);
    }
}
