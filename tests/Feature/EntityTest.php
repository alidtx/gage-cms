<?php

namespace Tests\Feature;

use App\Models\Entity;
use App\Models\EntityProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class EntityTest extends TestCase
{
    use RefreshDatabase;

    public function test_entities_can_be_created_updated_and_deleted_with_images(): void
    {
        Storage::fake();
        $this->actingAs(User::factory()->create());
        $data = ['title' => 'Example entity', 'bio' => 'Introduction', 'description' => 'Full description', 'badge' => 'Partner'];
        $this->post('/backend/entities', [...$data, 'image' => UploadedFile::fake()->image('logo.png')])
            ->assertSessionHasNoErrors()->assertRedirect('/backend/entities');
        $entity = Entity::firstOrFail();
        $this->assertDatabaseHas('entities', $data);
        $oldImage = $entity->media;
        Storage::assertExists($oldImage->src);
        $this->get('/backend/entities/'.$entity->id.'/image')->assertOk()->assertHeader('Content-Type', 'image/png');
        $this->put('/backend/entities/'.$entity->id, [...$data, 'title' => 'Updated entity'])
            ->assertSessionHasNoErrors()->assertRedirect('/backend/entities');
        $this->assertSame($oldImage->id, $entity->fresh()->media_id);
        $this->assertSame('Updated entity', $entity->fresh()->title);
        $this->post('/backend/entities/'.$entity->id, [...$data, '_method' => 'put', 'image' => UploadedFile::fake()->image('new.jpg')])
            ->assertSessionHasNoErrors();
        Storage::assertMissing($oldImage->src);
        $newImage = $entity->fresh()->media;
        Storage::assertExists($newImage->src);
        EntityProfile::create(['entity_id' => $entity->id, 'content' => ['text' => 'Profile']]);
        $this->delete('/backend/entities/'.$entity->id)->assertRedirect('/backend/entities');
        $this->assertDatabaseMissing('entities', ['id' => $entity->id]);
        $this->assertDatabaseMissing('entity_profiles', ['entity_id' => $entity->id]);
        $this->assertDatabaseMissing('media', ['id' => $newImage->id]);
        Storage::assertMissing($newImage->src);
    }

    public function test_list_paginates_and_entities_work_without_optional_fields(): void
    {
        $this->actingAs(User::factory()->create())->post('/backend/entities', ['title' => 'Minimal'])
            ->assertSessionHasNoErrors();
        $entity = Entity::firstOrFail();
        $this->get('/backend/entities/'.$entity->id.'/image')->assertNotFound();
        Entity::factory()->count(10)->create();
        $this->withoutVite()->get('/backend/entities')->assertOk()->assertInertia(fn (Assert $page) => $page
            ->component('Backend/Entity/Index')->has('entities.data', 10)->where('entities.total', 11));
        $this->get('/backend/entities?page=2')->assertInertia(fn (Assert $page) => $page->has('entities.data', 1));
        $this->delete('/backend/entities/'.$entity->id)->assertRedirect('/backend/entities');
        $this->assertDatabaseMissing('entities', ['id' => $entity->id]);
    }

    public function test_invalid_entity_input_does_not_change_records(): void
    {
        Storage::fake();
        $entity = Entity::factory()->create();
        $this->actingAs(User::factory()->create());
        $this->post('/backend/entities', ['title' => '', 'bio' => str_repeat('a', 256), 'badge' => str_repeat('b', 256),
            'description' => str_repeat('c', 10001), 'image' => UploadedFile::fake()->create('file.svg', 10, 'image/svg+xml')])
            ->assertSessionHasErrors(['title', 'bio', 'badge', 'description', 'image']);
        $this->put('/backend/entities/'.$entity->id, ['title' => str_repeat('a', 256)])
            ->assertSessionHasErrors('title');
        $this->post('/backend/entities', ['title' => 'Large image', 'image' => UploadedFile::fake()->image('large.png')->size(5121)])
            ->assertSessionHasErrors('image');
        $this->assertDatabaseCount('entities', 1);
        $this->assertSame($entity->title, $entity->fresh()->title);
        $this->assertSame([], Storage::allFiles());
    }

    public function test_guests_cannot_manage_entities_and_missing_entities_return_not_found(): void
    {
        $entity = Entity::factory()->create();
        $this->get('/backend/entities')->assertRedirect('/login');
        $this->get('/backend/entities/'.$entity->id.'/image')->assertRedirect('/login');
        $this->post('/backend/entities', ['title' => 'Blocked'])->assertRedirect('/login');
        $this->put('/backend/entities/'.$entity->id, ['title' => 'Blocked'])->assertRedirect('/login');
        $this->delete('/backend/entities/'.$entity->id)->assertRedirect('/login');
        $this->assertDatabaseHas('entities', ['id' => $entity->id, 'title' => $entity->title]);
        $this->actingAs(User::factory()->create())->put('/backend/entities/99999', ['title' => 'Missing'])->assertNotFound();
        $this->delete('/backend/entities/99999')->assertNotFound();
    }
}
