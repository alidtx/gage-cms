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
        $data = ['title' => 'Security', 'description' => 'Protection services', 'entity_id' => $entity->id];

        $this->post('/backend/services', $data)->assertSessionHasNoErrors()->assertRedirect('/backend/services');
        $service = Service::firstOrFail();
        $this->assertDatabaseHas('services', $data);

        $this->put('/backend/services/'.$service->id, ['title' => 'Safety', 'entity_id' => $entity->id])
            ->assertSessionHasNoErrors()->assertRedirect('/backend/services');
        $this->assertDatabaseHas('services', ['id' => $service->id, 'title' => 'Safety', 'entity_id' => $entity->id]);

        $this->delete('/backend/services/'.$service->id)->assertRedirect('/backend/services');
        $this->assertModelMissing($service);
    }

    public function test_image_is_preserved_replaced_served_and_deleted(): void
    {
        Storage::fake();
        $this->actingAs(User::factory()->create());
        $this->post('/backend/services', ['title' => 'Security', 'entity_id' => Entity::factory()->create()->id, 'icon' => UploadedFile::fake()->createWithContent('icon.svg', '<svg xmlns="http://www.w3.org/2000/svg"><path d="M0 0h10v10z"/></svg>')])
            ->assertSessionHasNoErrors();
        $service = Service::firstOrFail();
        $original = $service->media;
        Storage::assertExists($original->src);
        $this->get('/backend/services/'.$service->id.'/image')->assertOk()->assertHeader('Content-Type', 'image/svg+xml');

        $this->put('/backend/services/'.$service->id, ['title' => 'Safety', 'entity_id' => $service->entity_id])->assertSessionHasNoErrors();
        $this->assertSame($original->id, $service->fresh()->media_id);
        Storage::assertExists($original->src);

        $this->post('/backend/services/'.$service->id, ['_method' => 'put', 'title' => 'Safety', 'entity_id' => $service->entity_id, 'icon' => UploadedFile::fake()->createWithContent('replacement.svg', '<svg xmlns="http://www.w3.org/2000/svg"><circle r="5"/></svg>')])
            ->assertSessionHasNoErrors();
        $replacement = $service->fresh()->media;
        Storage::assertMissing($original->src);
        $this->assertModelMissing($original);
        Storage::assertExists($replacement->src);

        $this->delete('/backend/services/'.$service->id)->assertRedirect('/backend/services');
        Storage::assertMissing($replacement->src);
        $this->assertModelMissing($replacement);
    }

    public function test_invalid_fields_and_svg_are_rejected(): void
    {
        $entity = Entity::factory()->create();
        $this->actingAs(User::factory()->create());
        $this->post('/backend/services', ['title' => 'Service'])->assertSessionHasErrors('entity_id');
        $data = ['title' => 'Service', 'entity_id' => $entity->id];
        $this->post('/backend/services', [...$data, 'description' => str_repeat('x', 161)])->assertSessionHasErrors('description');
        foreach (['<svg><script>alert(1)</script></svg>', '<svg onload="alert(1)"/>', '<html/>'] as $svg) {
            $this->post('/backend/services', [...$data, 'icon' => UploadedFile::fake()->createWithContent('bad.svg', $svg)])->assertSessionHasErrors('icon');
        }
        $this->post('/backend/services', [...$data, 'description' => str_repeat('x', 160)])->assertSessionHasNoErrors();
        $service = Service::firstOrFail();
        $this->put('/backend/services/'.$service->id, ['title' => 'Updated', 'entity_id' => null])->assertSessionHasErrors('entity_id');
        $entity->delete();
        $this->post('/backend/services', $data)->assertSessionHasErrors('entity_id');
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
