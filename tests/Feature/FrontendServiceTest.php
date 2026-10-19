<?php

namespace Tests\Feature;

use App\Models\Entity;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FrontendServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_each_company_displays_only_its_services(): void
    {
        $slugs = ['gage_security', 'gage_fire_safety', 'gage_technology'];
        foreach ($slugs as $slug) {
            $entity = Entity::factory()->create(['slug' => $slug, 'is_active' => true]);
            Service::factory()->for($entity)->create(['title' => 'Service for '.$slug, 'link' => '/contact']);
        }
        foreach ($slugs as $slug) {
            $response = $this->get('/'.str_replace('_', '-', $slug))->assertOk()->assertSee('Service for '.$slug);
            foreach (array_diff($slugs, [$slug]) as $other) {
                $response->assertDontSee('Service for '.$other);
            }
        }
    }

    public function test_legacy_slug_and_hidden_inactive_services(): void
    {
        $entity = Entity::factory()->create(['slug' => 'gage-security', 'is_active' => true]);
        Service::factory()->for($entity)->create(['title' => 'Legacy service', 'link' => 'javascript:alert(1)']);
        $this->get('/gage-security')->assertOk()->assertSee('Legacy service')->assertDontSee('javascript:alert(1)', false);
        $entity->update(['is_active' => false]);
        $this->get('/gage-security')->assertOk()->assertDontSee('Legacy service');
        $entity->delete();
        $this->get('/gage-security')->assertOk()->assertDontSee('Legacy service');
    }

    public function test_uploaded_icon_is_public_only_for_its_active_owner(): void
    {
        Storage::fake();
        $entity = Entity::factory()->create(['slug' => 'gage_security', 'is_active' => true]);
        $this->actingAs(User::factory()->create())->post('/backend/services', [
            'title' => 'Uploaded service', 'entity_id' => $entity->id,
            'icon' => UploadedFile::fake()->createWithContent('icon.svg', '<svg xmlns="http://www.w3.org/2000/svg"><path d="M0 0h10v10z"/></svg>'),
        ])->assertSessionHasNoErrors();
        auth()->forgetGuards();
        $service = Service::firstOrFail();
        $url = route('frontend.service-icon', $service);
        $this->get('/gage-security')->assertOk()->assertSee($url, false);
        $this->get($url)->assertOk()->assertHeader('Content-Type', 'image/svg+xml');
        $other = Service::factory()->for($entity)->create(['media_id' => $service->media_id]);
        $this->get(route('frontend.service-icon', $other))->assertNotFound();
        $entity->update(['is_active' => false]);
        $this->get($url)->assertNotFound();
        $entity->delete();
        $this->get($url)->assertNotFound();
    }
}
