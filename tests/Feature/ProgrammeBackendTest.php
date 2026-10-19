<?php

namespace Tests\Feature;

use App\Models\Division;
use App\Models\Program;
use App\Models\ProgrammeGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProgrammeBackendTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_manage_catalogue_and_objectives(): void
    {
        $this->actingAs(User::factory()->create());
        $this->post('/backend/programme-groups', ['name' => 'Core Safety', 'sort_order' => 0])->assertSessionHasNoErrors();
        $group = ProgrammeGroup::firstOrFail();
        $this->assertSame('core_safety', $group->slug);
        $divisionData = ['name' => 'Emergency Response', 'programme_group_id' => $group->id, 'number' => 1, 'sort_order' => 0, 'is_published' => true, 'detail_url' => '/training'];
        $this->post('/backend/divisions', $divisionData)->assertSessionHasNoErrors();
        $division = Division::firstOrFail();
        $data = ['title' => 'First Aid', 'division_id' => $division->id, 'position' => 1, 'sort_order' => 0, 'is_published' => true, 'objectives' => ['Assess', 'Respond'], 'link_url' => '/contact'];
        $this->post('/backend/programs', $data)->assertSessionHasNoErrors();
        $program = Program::firstOrFail();
        $this->assertSame(['Assess', 'Respond'], $program->objectives->pluck('body')->all());
        $this->put('/backend/programs/'.$program->id, [...$data, 'title' => 'Advanced Aid', 'objectives' => ['Respond first']])->assertSessionHasNoErrors();
        $this->assertSame(['Respond first'], $program->fresh()->objectives->pluck('body')->all());
        $this->withoutVite()->get('/backend/programs')->assertInertia(fn (Assert $page) => $page->component('Backend/Program/Catalogue')->has('records.data', 1)->where('records.data.0.title', 'Advanced Aid'));
        $this->delete('/backend/divisions/'.$division->id)->assertSessionHasErrors('delete');
        $this->delete('/backend/programme-groups/'.$group->id)->assertSessionHasErrors('delete');
        $this->post('/backend/programs', $data)->assertSessionHasErrors('position');
        $this->put('/backend/programs/'.$program->id, [...$data, 'link_url' => 'javascript:alert(1)'])->assertSessionHasErrors('link_url');
        $this->put('/backend/programs/'.$program->id, [...$data, 'division_id' => 999])->assertSessionHasErrors('division_id');
        $this->delete('/backend/programs/'.$program->id)->assertRedirect();
        $this->assertDatabaseCount('programme_objectives', 0);
        $this->put('/backend/divisions/'.$division->id, $divisionData)->assertSessionHasNoErrors();
        $this->delete('/backend/divisions/'.$division->id)->assertRedirect();
        $this->delete('/backend/programme-groups/'.$group->id)->assertRedirect();
        $this->assertDatabaseCount('programme_groups', 0);
    }

    public function test_enquiry_status_updates_preserve_submitted_details(): void
    {
        $group = ProgrammeGroup::create(['name' => 'Core', 'slug' => 'core']);
        $division = $group->divisions()->create(['number' => 1, 'name' => 'Safety', 'slug' => 'safety']);
        $program = $division->programmes()->create(['position' => 1, 'title' => 'Aid']);
        $enquiry = $program->enquiries()->create(['programme_label' => 'Aid', 'full_name' => 'Learner', 'organisation' => 'Resort', 'email' => 'test@example.com', 'phone' => '123']);
        $this->actingAs(User::factory()->create())->withoutVite()->get('/backend/training-enquiries')->assertInertia(fn (Assert $page) => $page->component('Backend/Program/Enquiries')->has('enquiries.data', 1));
        $this->put('/backend/training-enquiries/'.$enquiry->id, ['status' => 'quoted', 'full_name' => 'Changed'])->assertSessionHasNoErrors();
        $this->assertSame('quoted', $enquiry->fresh()->status);
        $this->assertSame('Learner', $enquiry->fresh()->full_name);
        $this->put('/backend/training-enquiries/'.$enquiry->id, ['status' => 'invalid'])->assertSessionHasErrors('status');
        $this->delete('/backend/programs/'.$program->id)->assertRedirect();
        $this->assertNull($enquiry->fresh()->programme_id);
        $this->delete('/backend/training-enquiries/'.$enquiry->id)->assertRedirect();
        $this->assertModelMissing($enquiry);
    }

    public function test_guests_cannot_manage_programme_module(): void
    {
        foreach (['programs', 'divisions', 'programme-groups', 'training-enquiries'] as $path) {
            $this->get('/backend/'.$path)->assertRedirect('/login');
            $this->put('/backend/'.$path.'/1', [])->assertRedirect('/login');
            $this->delete('/backend/'.$path.'/1')->assertRedirect('/login');
        }
        foreach (['programs', 'divisions', 'programme-groups'] as $path) {
            $this->post('/backend/'.$path,[])->assertRedirect('/login');
        }
    }
}
