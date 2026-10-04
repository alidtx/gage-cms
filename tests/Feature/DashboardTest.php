<?php

namespace Tests\Feature;

use App\Models\ContactSubmission;
use App\Models\Entity;
use App\Models\News;
use App\Models\PageContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_shows_real_counts_and_bounded_recent_lists(): void
    {
        PageContent::factory()->count(6)->create(['updated_at' => now()->subDay()]);
        $latest = PageContent::factory()->create(['name' => 'Latest page']);
        PageContent::factory()->create()->delete();
        Entity::factory()->count(2)->create();
        Entity::factory()->create(['is_active' => false]);
        Entity::factory()->create()->delete();
        News::factory()->count(2)->create(['status' => 'published']);
        $news = News::factory()->create(['status' => 'draft']);
        ContactSubmission::factory()->count(6)->create();
        $message = ContactSubmission::latest('id')->first();
        $this->actingAs(User::factory()->create())->withoutVite()->get('/dashboard')->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('Dashboard')
                ->where('stats.pages', 7)->where('stats.entities', 2)->where('stats.news', 2)->where('stats.messages', 6)
                ->has('recentMessages', 5)->where('recentMessages.0.id', $message->id)
                ->has('latestNews', 3)->where('latestNews.0.id', $news->id)->has('latestNews.0.category')
                ->has('recentPages', 5)->where('recentPages.0.id', $latest->id));
    }

    public function test_dashboard_handles_empty_data_and_requires_login(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
        $this->actingAs(User::factory()->create())->withoutVite()->get('/dashboard')->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('Dashboard')
                ->where('stats.pages', 0)->where('stats.entities', 0)->where('stats.news', 0)->where('stats.messages', 0)
                ->has('recentMessages', 0)->has('latestNews', 0)->has('recentPages', 0));
    }
}
