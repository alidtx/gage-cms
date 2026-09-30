<?php

namespace Tests\Feature;

use App\Models\Entity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class EntityTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_edit_and_save_content_and_metadata(): void
    {
        $this->actingAs(User::factory()->create())->post('/backend/entities', [
            'name' => 'GAGE Security', 'category' => 'security',
        ])->assertSessionHasNoErrors();
        $entity = Entity::firstOrFail();
        $this->assertSame('gage-security', $entity->slug);
        $this->assertTrue($entity->is_active);
        $this->withoutVite()->get('/backend/entities/'.$entity->id.'/edit')->assertOk()
            ->assertInertia(fn (Assert $page) => $page->component('Backend/Entity/Edit')->where('entity.name', 'GAGE Security'));
        $content = [
            'hero' => ['title_line_1' => 'Safety', 'badge' => ['text' => 'GAGE'], 'trust_badges' => ['24/7']],
            'sections' => [['key' => 'services', 'title' => 'Services', 'items' => [['title' => 'Protection']]]],
            'team' => [['name' => 'Alex', 'tags' => ['Expert']]],
            'partners' => [['name' => 'Partner']],
            'contact' => ['email' => 'hello@example.com'],
            'faqs' => [['question' => 'Where?', 'answer' => 'Maldives']],
        ];
        $meta = ['tagline' => 'Security solutions', 'primary_color' => '#bb292a', 'meta_title' => 'Security'];
        $data = ['name' => 'GAGE Safety', 'slug' => $entity->slug, 'category' => 'safety', 'is_active' => false,
            'is_featured' => true, 'sort_order' => 3, 'content' => json_encode($content), 'meta' => json_encode($meta)];
        $this->post('/backend/entities/'.$entity->id, [...$data, '_method' => 'put'])
            ->assertSessionHasNoErrors()->assertRedirect('/backend/entities/'.$entity->id.'/edit');
        $saved = $entity->fresh();
        $this->assertSame($content, $saved->content);
        $this->assertSame($meta, $saved->meta);
        $this->assertSame('GAGE Safety', $saved->name);
        $this->assertFalse($saved->is_active);
        $this->assertTrue($saved->is_featured);
        $this->assertEquals(3, $saved->sort_order);
        $this->put('/backend/entities/'.$entity->id, [...$data, 'content' => '{}', 'meta' => '{}'])
            ->assertSessionHasNoErrors();
        $this->assertSame([], $entity->fresh()->content);
        $this->assertSame([], $entity->fresh()->meta);
    }

    public function test_cards_filter_order_paginate_and_count_real_entities(): void
    {
        $first = Entity::factory()->create(['name' => 'GAGE Security', 'sort_order' => 0, 'is_featured' => true]);
        Entity::factory()->count(12)->create(['name' => 'GAGE Other', 'sort_order' => 5]);
        Entity::factory()->create(['name' => 'Marine Entity', 'category' => 'marine', 'is_active' => false]);
        Entity::factory()->create()->delete();
        $this->actingAs(User::factory()->create())->withoutVite()->get('/backend/entities')
            ->assertInertia(fn (Assert $page) => $page->component('Backend/Entity/Index')
                ->has('entities.data', 12)->where('entities.total', 14)
                ->where('entities.data.0.id', $first->id)->where('stats.total', 14)
                ->where('stats.active', 13)->where('stats.featured', 1)->where('stats.inactive', 1));
        $this->get('/backend/entities?search=GAGE&category=security&page=2')
            ->assertInertia(fn (Assert $page) => $page->has('entities.data', 1)->where('entities.total', 13));
        $this->get('/backend/entities?category=marine')->assertInertia(fn (Assert $page) => $page->where('entities.total', 1));
        $this->get('/backend/entities?search=missing')->assertInertia(fn (Assert $page) => $page->has('entities.data', 0));
        $this->get('/backend/entities?category=invalid')->assertSessionHasErrors('category');
    }

    public function test_images_replace_safely_and_soft_delete_preserves_media(): void
    {
        Storage::fake();
        $entity = Entity::factory()->create();
        $this->actingAs(User::factory()->create());
        $this->get('/backend/entities/'.$entity->id.'/image')->assertNotFound();
        $data = ['name' => $entity->name, 'slug' => $entity->slug, 'category' => 'security'];
        $this->post('/backend/entities/'.$entity->id, [...$data, '_method' => 'put', 'image' => UploadedFile::fake()->image('logo.png')])
            ->assertSessionHasNoErrors();
        $oldImage = $entity->fresh()->media;
        Storage::assertExists($oldImage->src);
        $this->get('/backend/entities/'.$entity->id.'/image')->assertOk()->assertHeader('Content-Type', 'image/png');
        $this->put('/backend/entities/'.$entity->id, $data)->assertSessionHasNoErrors();
        $this->assertSame($oldImage->id, $entity->fresh()->media_id);
        $this->post('/backend/entities/'.$entity->id, [...$data, '_method' => 'put', 'image' => UploadedFile::fake()->image('new.jpg')])
            ->assertSessionHasNoErrors();
        Storage::assertMissing($oldImage->src);
        $image = $entity->fresh()->media;
        $this->from('/backend/entities')->patch('/backend/entities/'.$entity->id.'/active')->assertRedirect('/backend/entities');
        $this->assertFalse($entity->fresh()->is_active);
        $this->delete('/backend/entities/'.$entity->id)->assertRedirect('/backend/entities');
        $this->assertSoftDeleted($entity);
        Storage::assertExists($image->src);
        $this->get('/backend/entities/'.$entity->id.'/edit')->assertNotFound();
        $this->get('/backend/entities/'.$entity->id.'/image')->assertNotFound();
    }

    public function test_validation_rejects_duplicates_invalid_content_and_uploads(): void
    {
        Storage::fake();
        $entity = Entity::factory()->create();
        $this->actingAs(User::factory()->create());
        $this->post('/backend/entities', ['name' => '', 'slug' => $entity->slug, 'category' => 'invalid',
            'is_active' => 'bad', 'is_featured' => 'bad', 'sort_order' => -1, 'content' => '{bad',
            'meta' => 'bad', 'image' => UploadedFile::fake()->create('bad.svg', 10, 'image/svg+xml')])
            ->assertSessionHasErrors(['name', 'slug', 'category', 'is_active', 'is_featured', 'sort_order', 'content', 'meta', 'image']);
        $data = ['name' => 'Valid', 'category' => 'security'];
        $this->post('/backend/entities', [...$data, 'content' => ['sections' => 'bad', 'hero' => ['trust_badges' => 'bad']],
            'meta' => ['primary_color' => 'invalid']])->assertSessionHasErrors(['content.sections', 'content.hero.trust_badges', 'meta.primary_color']);
        $this->post('/backend/entities', [...$data, 'image' => UploadedFile::fake()->image('large.png')->size(5121)])
            ->assertSessionHasErrors('image');
        $this->assertDatabaseCount('entities', 1);
        $this->assertSame([], Storage::allFiles());
    }

    public function test_guests_cannot_manage_entities_and_missing_records_return_not_found(): void
    {
        $entity = Entity::factory()->create();
        $this->get('/backend/entities')->assertRedirect('/login');
        $this->get('/backend/entities/'.$entity->id.'/edit')->assertRedirect('/login');
        $this->get('/backend/entities/'.$entity->id.'/image')->assertRedirect('/login');
        $this->post('/backend/entities', [])->assertRedirect('/login');
        $this->put('/backend/entities/'.$entity->id, [])->assertRedirect('/login');
        $this->patch('/backend/entities/'.$entity->id.'/active')->assertRedirect('/login');
        $this->delete('/backend/entities/'.$entity->id)->assertRedirect('/login');
        $this->assertNotSoftDeleted($entity);
        $this->actingAs(User::factory()->create())->get('/backend/entities/99999/edit')->assertNotFound();
        $this->delete('/backend/entities/99999')->assertNotFound();
    }
}
