<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTrainingEnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->route('division')?->is_published;
    }

    /** @return array<string,mixed> */
    public function rules(): array
    {
        return [
            'programme_id' => ['required', 'integer', Rule::exists('programmes', 'id')->where('division_id', $this->route('division')->id)->where('is_published', true)],
            'full_name' => ['required', 'string', 'max:255'], 'organisation' => ['required', 'string', 'max:255'], 'email' => ['required', 'email', 'max:255'], 'phone' => ['required', 'string', 'max:32'],
            'participants' => ['nullable', 'integer', 'min:1', 'max:65535'], 'delivery_preference' => ['nullable', Rule::in(['on_site', 'male_weekends', 'virtual'])],
        ];
    }
}
