<?php

namespace Tests\Feature;

use App\Models\ProgrammeGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProgrammeRelationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_catalogue_relationships_and_enquiry_retention(): void
    {
        $group = ProgrammeGroup::create(['name' => 'Safety', 'slug' => 'safety']);
        $division = $group->divisions()->create(['number' => 1, 'slug' => 'emergency-response', 'name' => 'Emergency Response']);
        $program = $division->programmes()->create(['position' => 4, 'title' => 'Lifeguard Training']);
        $later = $program->objectives()->create(['body' => 'Rescue safely', 'sort_order' => 2]);
        $first = $program->objectives()->create(['body' => 'Assess risk', 'sort_order' => 1]);
        $enquiry = $program->enquiries()->create([
            'programme_label' => 'Lifeguard Training', 'full_name' => 'Test Learner',
            'organisation' => 'Resort', 'email' => 'learner@example.com', 'phone' => '+9601234567',
            'participants' => 12,
        ]);

        $this->assertTrue($division->group->is($group));
        $this->assertTrue($program->division->is($division));
        $this->assertTrue($group->programmes->sole()->is($program));
        $this->assertSame('1.4', $program->display_code);
        $this->assertSame([$first->id, $later->id], $program->objectives->modelKeys());
        $this->assertTrue($first->programme->is($program));
        $this->assertTrue($enquiry->programme->is($program));
        $this->assertTrue($program->enquiries->sole()->is($enquiry));

        $program->delete();
        $this->assertModelMissing($first);
        $this->assertModelMissing($later);
        $this->assertNull($enquiry->fresh()->programme_id);
        $this->assertSame('Lifeguard Training', $enquiry->fresh()->programme_label);
    }
}
