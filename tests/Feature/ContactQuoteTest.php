<?php

namespace Tests\Feature;

use App\Models\ContactSubmission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class ContactQuoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_quote_is_saved_with_every_detail_and_visible_in_dashboard(): void
    {
        $this->get('/contact')->assertOk()->assertViewIs('frontend.pages.contact')
            ->assertSee('name="_token"', false)->assertDontSee('event.preventDefault()', false)
            ->assertSee('<title>Contact GAGE | Request a Quote</title>', false);
        $this->post('/contact', [
            'enquiry_type' => 'quote', 'full_name' => 'Alex', 'email_address' => 'alex@example.com',
            'phone_number' => '+9601234567', 'company' => 'Island Resort', 'gage_company' => 'fire',
            'service' => 'fire', 'island' => 'Baa Atoll', 'contact_method' => 'email',
            'consent' => '1', 'message' => 'We need an inspection.',
        ])->assertSessionHasNoErrors()->assertRedirect('/contact');
        $this->get('/contact')->assertSee('Your enquiry has been sent to the GAGE team.');

        $submission = ContactSubmission::firstOrFail();
        $this->assertSame('Quote enquiry — GAGE Fire Safety', $submission->subject);
        foreach (['We need an inspection.', 'Island Resort', 'Fire safety', 'Baa Atoll', 'Preferred contact method: Email', 'Consent to contact and handling of details: Yes'] as $detail) {
            $this->assertStringContainsString($detail, $submission->message);
        }
        $this->withoutVite()->actingAs(User::factory()->create())
            ->get('/backend/contact-submissions/'.$submission->id)
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->where('submission.message', $submission->message)
                ->where('submission.subject', $submission->subject));
    }

    public function test_invalid_quote_repopulates_form_and_is_not_saved(): void
    {
        $this->from('/contact')->post('/contact', [
            'enquiry_type' => 'quote', 'full_name' => 'Alex', 'email_address' => 'invalid',
            'gage_company' => 'unknown', 'service' => 'unknown', 'contact_method' => 'unknown',
            'message' => 'Please help', 'company' => 'Island Resort',
        ])->assertRedirect('/contact')->assertSessionHasErrors(['email_address', 'phone_number', 'gage_company', 'service', 'contact_method', 'consent']);
        session()->reflash();
        session()->save();
        $this->get('/contact')->assertOk()->assertSee('Island Resort')->assertSee('Please help')
            ->assertSee('Please correct the following:');
        $this->assertDatabaseCount('contact_submissions', 0);
    }
}
