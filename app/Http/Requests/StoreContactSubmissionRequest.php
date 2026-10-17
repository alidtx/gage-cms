<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactSubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'email_address' => ['required', 'email', 'max:255'],
            'phone_number' => ['required_if:enquiry_type,quote', 'nullable', 'string', 'max:255'],
            'subject' => ['required_unless:enquiry_type,quote', 'nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:10000'],
            'enquiry_type' => ['nullable', 'in:quote'],
            'company' => ['nullable', 'string', 'max:255'],
            'gage_company' => ['required_if:enquiry_type,quote', 'nullable', 'in:security,fire,training,technology,unsure'],
            'service' => ['nullable', 'in:security,fire,training,technology,other'],
            'island' => ['nullable', 'string', 'max:255'],
            'contact_method' => ['nullable', 'in:either,phone,email'],
            'consent' => ['exclude_unless:enquiry_type,quote', 'required', 'accepted'],
        ];
    }
}
