<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ContactSubmissionController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Backend/ContactSubmission/Index', [
            'submissions' => ContactSubmission::select(['id', 'full_name', 'email_address', 'subject', 'created_at'])
                ->latest('id')->paginate(15),
        ]);
    }

    public function show(ContactSubmission $contactSubmission): Response
    {
        return Inertia::render('Backend/ContactSubmission/Show', ['submission' => $contactSubmission]);
    }

    public function destroy(ContactSubmission $contactSubmission): RedirectResponse
    {
        $contactSubmission->delete();

        return to_route('backend.contact-submissions.index');
    }
}
