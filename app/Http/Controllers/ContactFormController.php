<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactSubmissionRequest;
use App\Models\ContactSubmission;
use App\Services\FrontendHero;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactFormController extends Controller
{
    public function create(FrontendHero $heroes): View
    {
        return view('frontend.pages.contact', ['heroContent' => $heroes->forPage('contact'), 'pageSeo' => [
            'title' => 'Contact GAGE | Request a Quote',
            'description' => 'Contact GAGE for security, fire safety, training and technology enquiries across the Maldives.',
        ]]);
    }

    public function store(StoreContactSubmissionRequest $request): RedirectResponse
    {
        $data = $request->safe()->only(['full_name', 'email_address', 'phone_number', 'subject', 'message']);
        if ($request->validated('enquiry_type') === 'quote') {
            $companies = ['security' => 'GAGE Security', 'fire' => 'GAGE Fire Safety', 'training' => 'GAGE Training Institute', 'technology' => 'GAGE Technology', 'unsure' => 'Help choosing a company'];
            $services = ['security' => 'Security services', 'fire' => 'Fire safety', 'training' => 'Training programmes', 'technology' => 'Technology solutions', 'other' => 'Other / not sure'];
            $methods = ['either' => 'Phone or email', 'phone' => 'Phone', 'email' => 'Email'];
            $company = $companies[$request->validated('gage_company')];
            $data['subject'] = 'Quote enquiry — '.$company;
            $data['message'] .= "\n\nEnquiry details\n"
                .'Company / property: '.($request->validated('company') ?: 'Not provided')."\n"
                .'GAGE company: '.$company."\n"
                .'Service of interest: '.($services[$request->validated('service')] ?? 'Not specified')."\n"
                .'Island / atoll: '.($request->validated('island') ?: 'Not provided')."\n"
                .'Preferred contact method: '.($methods[$request->validated('contact_method')] ?? 'Phone or email')."\n"
                .'Consent to contact and handling of details: Yes';
        }
        ContactSubmission::create($data);

        return to_route('contact.create')->with('status', 'Thank you. Your enquiry has been sent to the GAGE team.');
    }
}
