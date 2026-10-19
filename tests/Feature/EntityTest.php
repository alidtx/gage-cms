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

    public function test_six_fields_save_and_removed_fields_cannot_be_updated(): void
    {
        $this->actingAs(User::factory()->create())->post('/backend/entities', [
            'name' => 'GAGE Security', 'category' => 'security', 'short_description' => 'Security services', 'link' => '/gage-security',
        ])->assertSessionHasNoErrors();
        $entity = Entity::firstOrFail();
        $this->assertSame('gage_security', $entity->slug);
        $this->assertSame('Security services', $entity->short_description);
        $this->assertSame('/gage-security', $entity->meta['link']);
        $entity->update(['content' => ['hero' => ['title_line_1' => 'Legacy content']]]);
        $this->put('/backend/entities/'.$entity->id, [
            'name' => 'Updated', 'slug' => 'updated', 'category' => 'training', 'short_description' => 'Updated description', 'link' => 'https://example.com/training',
            'content' => ['hero' => []], 'meta' => ['icon' => 'changed'], 'is_active' => false, 'is_featured' => true, 'sort_order' => 99,
        ])->assertSessionHasNoErrors();
        $entity->refresh();
        $this->assertSame('updated', $entity->slug);
        $this->assertSame('training', $entity->category);
        $this->assertSame('Updated description', $entity->short_description);
        $this->assertSame('https://example.com/training', $entity->meta['link']);
        $this->assertSame(['hero' => ['title_line_1' => 'Legacy content']], $entity->content);
        $this->assertTrue($entity->is_active);
        $this->assertFalse($entity->is_featured);
        $this->withoutVite()->get('/backend/entities/'.$entity->id.'/edit')->assertInertia(fn (Assert $page) => $page
            ->component('Backend/Entity/Edit')->where('entity.link', 'https://example.com/training')->missing('entity.content')->missing('entity.meta'));
        $this->put('/backend/entities/'.$entity->id, ['name' => 'Updated', 'slug' => 'updated', 'category' => 'training', 'short_description' => '', 'link' => ''])->assertSessionHasNoErrors();
        $this->assertNull($entity->fresh()->meta['link']);
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
                ->where('entities.data.0.id', $first->id)->missing('stats'));
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
        $this->delete('/backend/entities/'.$entity->id)->assertRedirect('/backend/entities');
        $this->assertSoftDeleted($entity);
        Storage::assertExists($image->src);
        $this->get('/backend/entities/'.$entity->id.'/edit')->assertNotFound();
        $this->get('/backend/entities/'.$entity->id.'/image')->assertNotFound();
    }

    public function test_validation_rejects_duplicates_invalid_links_and_uploads(): void
    {
        Storage::fake();
        $entity = Entity::factory()->create();
        $this->actingAs(User::factory()->create());
        $this->post('/backend/entities', ['name' => '', 'slug' => $entity->slug, 'category' => 'invalid',
            'image' => UploadedFile::fake()->create('bad.svg', 10, 'image/svg+xml')])->assertSessionHasErrors(['name', 'slug', 'category', 'image']);
        foreach (['javascript:alert(1)', '//evil.example', '/\\evil.example', 'not a link'] as $link) {
            $this->post('/backend/entities', ['name' => 'Valid', 'category' => 'security', 'link' => $link])->assertSessionHasErrors('link');
        }
        $this->post('/backend/entities', ['name' => 'Valid', 'category' => 'security', 'short_description' => str_repeat('x', 141), 'image' => UploadedFile::fake()->image('large.png')->size(5121)])
            ->assertSessionHasErrors(['short_description', 'image']);
        $this->assertDatabaseCount('entities', 1);
        $this->assertSame([], Storage::allFiles());
    }

    public function test_description_accepts_140_characters_and_rejects_141_on_update(): void
    {
        $data = ['name' => 'Short text', 'category' => 'security', 'short_description' => str_repeat('x', 140)];
        $this->actingAs(User::factory()->create())->post('/backend/entities', $data)->assertSessionHasNoErrors();
        $entity = Entity::firstOrFail();
        $this->assertSame($data['short_description'], $entity->short_description);
        $this->put('/backend/entities/'.$entity->id, [...$data, 'short_description' => str_repeat('x', 141)])->assertSessionHasErrors('short_description');
        $this->assertSame($data['short_description'], $entity->fresh()->short_description);
    }

    public function test_guests_cannot_manage_entities_and_missing_records_return_not_found(): void
    {
        $entity = Entity::factory()->create();
        $this->get('/backend/entities')->assertRedirect('/login');
        $this->get('/backend/entities/'.$entity->id.'/edit')->assertRedirect('/login');
        $this->get('/backend/entities/'.$entity->id.'/image')->assertRedirect('/login');
        $this->post('/backend/entities', [])->assertRedirect('/login');
        $this->put('/backend/entities/'.$entity->id, [])->assertRedirect('/login');
        $this->delete('/backend/entities/'.$entity->id)->assertRedirect('/login');
        $this->assertNotSoftDeleted($entity);
        $this->actingAs(User::factory()->create())->get('/backend/entities/99999/edit')->assertNotFound();
        $this->delete('/backend/entities/99999')->assertNotFound();
    }
}
