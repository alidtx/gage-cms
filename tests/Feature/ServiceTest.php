<?php

namespace Tests\Feature;

use App\Models\Entity;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_services_can_be_created_updated_and_deleted(): void
    {
        $entity = Entity::factory()->create();
        $this->actingAs(User::factory()->create());
        $data = ['title' => 'Security', 'icon' => 'fa-shield-alt', 'description' => 'Protection services', 'badge' => 'Core', 'entity_id' => $entity->id];

        $this->post('/backend/services', $data)->assertSessionHasNoErrors()->assertRedirect('/backend/services');
        $service = Service::firstOrFail();
        $this->assertDatabaseHas('services', $data);

        $this->put('/backend/services/'.$service->id, ['title' => 'Safety', 'entity_id' => null, 'badge' => null])
            ->assertSessionHasNoErrors()->assertRedirect('/backend/services');
        $this->assertDatabaseHas('services', ['id' => $service->id, 'title' => 'Safety', 'entity_id' => null, 'badge' => null]);

        $this->delete('/backend/services/'.$service->id)->assertRedirect('/backend/services');
        $this->assertModelMissing($service);
    }

    public function test_image_is_preserved_replaced_served_and_deleted(): void
    {
        Storage::fake();
        $this->actingAs(User::factory()->create());
        $this->post('/backend/services', ['title' => 'Security', 'image' => UploadedFile::fake()->image('security.png')])
            ->assertSessionHasNoErrors();
        $service = Service::firstOrFail();
        $original = $service->media;
        Storage::assertExists($original->src);
        $this->get('/backend/services/'.$service->id.'/image')->assertOk()->assertHeader('Content-Type', 'image/png');

        $this->put('/backend/services/'.$service->id, ['title' => 'Safety'])->assertSessionHasNoErrors();
        $this->assertSame($original->id, $service->fresh()->media_id);
        Storage::assertExists($original->src);

        $this->post('/backend/services/'.$service->id, ['_method' => 'put', 'title' => 'Safety', 'image' => UploadedFile::fake()->image('replacement.jpg')])
            ->assertSessionHasNoErrors();
        $replacement = $service->fresh()->media;
        Storage::assertMissing($original->src);
        $this->assertModelMissing($original);
        Storage::assertExists($replacement->src);

        $this->delete('/backend/services/'.$service->id)->assertRedirect('/backend/services');
        Storage::assertMissing($replacement->src);
        $this->assertModelMissing($replacement);
    }

    public function test_invalid_fields_and_images_do_not_create_services(): void
    {
        Storage::fake();
        $entity = Entity::factory()->create();
        $entity->delete();
        $this->actingAs(User::factory()->create());

        $this->post('/backend/services', ['title' => '', 'entity_id' => $entity->id, 'image' => UploadedFile::fake()->create('script.svg', 10, 'image/svg+xml')])
            ->assertSessionHasErrors(['title', 'entity_id', 'image']);
        $this->post('/backend/services', ['title' => 'Security', 'image' => UploadedFile::fake()->image('large.png')->size(5121)])
            ->assertSessionHasErrors('image');

        $this->assertDatabaseCount('services', 0);
        $this->assertSame([], Storage::allFiles());
    }

    public function test_index_lists_paginated_services_and_available_entities(): void
    {
        Service::factory()->count(13)->create();
        $entity = Entity::factory()->create();
        $latest = Service::factory()->for($entity)->create(['title' => 'Latest service']);

        $this->withoutVite()->actingAs(User::factory()->create())->get('/backend/services')
            ->assertInertia(fn (Assert $page) => $page->component('Backend/Service/Index')
                ->has('services.data', 12)->where('services.total', 14)
                ->where('services.data.0.id', $latest->id)
                ->where('services.data.0.entity.name', $entity->name)->has('entities', 1));
        $this->get('/backend/services/'.$latest->id.'/image')->assertNotFound();
    }

    public function test_guests_cannot_manage_services_or_access_images(): void
    {
        $service = Service::factory()->create();

        $this->get('/backend/services')->assertRedirect('/login');
        $this->post('/backend/services', ['title' => 'Unauthorized'])->assertRedirect('/login');
        $this->put('/backend/services/'.$service->id, ['title' => 'Unauthorized'])->assertRedirect('/login');
        $this->delete('/backend/services/'.$service->id)->assertRedirect('/login');
        $this->get('/backend/services/'.$service->id.'/image')->assertRedirect('/login');
        $this->assertDatabaseCount('services', 1);
        $this->assertDatabaseHas('services', ['id' => $service->id, 'title' => $service->title]);
    }
}
