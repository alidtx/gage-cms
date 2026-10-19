<?php

namespace Tests\Feature;

use App\Models\ProgrammeGroup;
use App\Models\TrainingEnquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrontendProgrammeTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_catalogue_details_and_enquiries(): void
    {
        $group = ProgrammeGroup::create(['name' => 'Core Training', 'slug' => 'core']);
        $division = $group->divisions()->create(['name' => 'Emergency Training', 'slug' => 'emergency_training', 'number' => 1, 'is_published' => true]);
        $program = $division->programmes()->create(['title' => 'First Aid Course', 'position' => 1, 'is_published' => true]);
        $program->objectives()->create(['body' => 'Respond safely']);
        $draft = $division->programmes()->create(['title' => 'Unpublished Course', 'position' => 2, 'is_published' => false]);
        $hidden = $group->divisions()->create(['name' => 'Hidden Division', 'slug' => 'hidden', 'number' => 2, 'is_published' => false]);
        $hidden->programmes()->create(['title' => 'Hidden Division Course', 'position' => 1, 'is_published' => true]);
        $this->get('/gage-training-instruction')->assertOk()->assertSee('Emergency Training')->assertDontSee('Hidden Division')->assertDontSee('DOWNLOAD A CATALOGUE');
        $this->get('/training/programmes')->assertOk()->assertSee('First Aid Course')->assertSee('#programme-1-1', false)->assertDontSee('Unpublished Course')->assertDontSee('Hidden Division Course');
        $url = '/training/divisions/emergency_training';
        $this->get($url)->assertOk()->assertSee('Respond safely')->assertSee('id="programme-1-1"', false)->assertDontSee('Unpublished Course');
        $this->get('/training/divisions/hidden')->assertNotFound();
        $data = ['programme_id' => $program->id, 'full_name' => 'Test Learner', 'organisation' => 'Test Resort', 'email' => 'learner@example.com', 'phone' => '+9601234567', 'participants' => 12, 'delivery_preference' => 'on_site', 'status' => 'closed'];
        $this->post($url.'/enquiry', $data)->assertSessionHasNoErrors()->assertSessionHas('training_success');
        $enquiry = TrainingEnquiry::firstOrFail();
        $this->assertSame('new', $enquiry->status);
        $this->assertSame('First Aid Course', $enquiry->programme_label);
        $this->assertSame($program->id, $enquiry->programme_id);
        $this->post($url.'/enquiry', [...$data, 'programme_id' => $draft->id])->assertSessionHasErrors('programme_id');
        $this->post($url.'/enquiry', [...$data, 'programme_id' => $hidden->programmes->first()->id])->assertSessionHasErrors('programme_id');
        $this->post($url.'/enquiry', [...$data, 'email' => 'bad', 'participants' => -1])->assertSessionHasErrors(['email', 'participants']);
        $this->assertDatabaseCount('training_enquiries', 1);
    }

    public function test_empty_catalogue_is_usable(): void
    {
        $this->get('/training/programmes')->assertOk();
        $this->get('/gage-training-instruction')->assertOk()->assertSee('No published divisions yet.');
    }
}
