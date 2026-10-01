<?php

namespace Tests\Feature;

use App\Models\ContactSubmission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ContactSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_form_submission_arrives_in_dashboard_and_can_be_viewed_and_deleted(): void
    {
        $this->withoutVite()->get('/contact')->assertOk();
        $data = ['full_name' => 'Alex Smith', 'email_address' => 'alex@example.com', 'phone_number' => '12345',
            'subject' => 'Service inquiry', 'message' => "Hello\nPlease contact me."];
        $this->post('/contact', $data)->assertSessionHasNoErrors()->assertRedirect('/contact');
        $this->assertDatabaseHas('contact_submissions', $data);
        $submission = ContactSubmission::firstOrFail();
        $this->actingAs(User::factory()->create())->get('/backend/contact-submissions')
            ->assertInertia(fn (Assert $page) => $page->component('Backend/ContactSubmission/Index')
                ->where('submissions.total', 1)->where('submissions.data.0.full_name', 'Alex Smith'));
        $this->get('/backend/contact-submissions/'.$submission->id)
            ->assertInertia(fn (Assert $page) => $page->component('Backend/ContactSubmission/Show')->where('submission.message', $data['message']));
        $this->delete('/backend/contact-submissions/'.$submission->id)->assertRedirect('/backend/contact-submissions');
        $this->assertDatabaseMissing('contact_submissions', ['id' => $submission->id]);
    }

    public function test_invalid_submissions_are_rejected_and_phone_is_optional(): void
    {
        $this->post('/contact', ['full_name' => '', 'email_address' => 'bad', 'subject' => '', 'message' => ''])
            ->assertSessionHasErrors(['full_name', 'email_address', 'subject', 'message']);
        $this->assertDatabaseCount('contact_submissions', 0);
        $this->post('/contact', ['full_name' => 'Alex', 'email_address' => 'alex@example.com', 'subject' => 'Hello', 'message' => 'Question'])
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('contact_submissions', ['phone_number' => null]);
    }

    public function test_guests_cannot_read_or_delete_submissions(): void
    {
        $submission = ContactSubmission::factory()->create();
        $this->get('/backend/contact-submissions')->assertRedirect('/login');
        $this->get('/backend/contact-submissions/'.$submission->id)->assertRedirect('/login');
        $this->delete('/backend/contact-submissions/'.$submission->id)->assertRedirect('/login');
        $this->assertDatabaseHas('contact_submissions', ['id' => $submission->id]);
        $this->actingAs(User::factory()->create())->get('/backend/contact-submissions/99999')->assertNotFound();
    }

    public function test_inbox_is_paginated_newest_first(): void
    {
        ContactSubmission::factory()->count(16)->create();
        $newest = ContactSubmission::latest('id')->first();
        $this->actingAs(User::factory()->create())->withoutVite()->get('/backend/contact-submissions')
            ->assertInertia(fn (Assert $page) => $page->has('submissions.data', 15)->where('submissions.total', 16)
                ->where('submissions.data.0.id', $newest->id));
        $this->get('/backend/contact-submissions?page=2')->assertInertia(fn (Assert $page) => $page->has('submissions.data', 1));
    }
}
