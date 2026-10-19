<?php

namespace Tests\Feature;

use App\Models\Entity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FrontendEntityTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_displays_entities_and_safe_links_only(): void
    {
        Entity::factory()->create(['name' => 'Managed company', 'meta' => ['short_description' => 'Managed description', 'link' => '/gage-security']]);
        Entity::factory()->create(['name' => 'Unsafe company', 'meta' => ['link' => 'javascript:alert(1)']]);
        Entity::factory()->create(['name' => 'Inactive company', 'is_active' => false]);
        Entity::factory()->create(['name' => 'Deleted company'])->delete();
        $this->get('/')->assertOk()->assertSee('Managed company')->assertSee('Managed description')
            ->assertSee('href="/gage-security"', false)->assertDontSee('javascript:alert(1)', false)
            ->assertDontSee('Inactive company')->assertDontSee('Deleted company');
        $this->view('frontend.components.entity-cards', ['entities' => collect()])->assertDontSee('<article', false);
    }

    public function test_uploaded_entity_image_is_public_and_hidden_after_deletion(): void
    {
        Storage::fake();
        $entity = Entity::factory()->create();
        $this->actingAs(User::factory()->create())->post('/backend/entities/'.$entity->id, [
            '_method' => 'put', 'name' => $entity->name, 'slug' => $entity->slug, 'category' => 'security',
            'image' => UploadedFile::fake()->image('company.png'),
        ])->assertSessionHasNoErrors();
        auth()->forgetGuards();
        $url = route('frontend.entity-image', $entity);
        $this->get('/')->assertOk()->assertSee($url, false);
        $this->get($url)->assertOk()->assertHeader('Content-Type', 'image/png');
        $entity->update(['is_active' => false]);
        $this->get($url)->assertNotFound();
        $entity->delete();
        $this->get($url)->assertNotFound();
    }
}
