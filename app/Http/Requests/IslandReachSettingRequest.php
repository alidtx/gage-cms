<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IslandReachSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'          => ['required', 'string', 'max:255'],
            'atoll'         => ['nullable', 'string', 'max:255'],
            'description'   => ['nullable', 'string'],
            'latitude'      => ['nullable', 'numeric', 'between:-90,90'],
            'longitude'     => ['nullable', 'numeric', 'between:-180,180'],
            'location_type' => ['required', Rule::in(['island', 'resort', 'city', 'airport', 'harbor', 'other'])],
            'is_featured'   => ['boolean'],
            'marker_color'  => ['nullable', 'string', 'max:20'],
            'marker_icon'   => ['nullable', 'string', 'max:255'],
            'sort_order'    => ['nullable', 'integer', 'min:0'],
            'is_active'     => ['boolean'],
        ];
    }

    /**
     * Custom attribute names for nicer error messages.
     */
    public function attributes(): array
    {
        return [
            'name'          => 'island name',
            'location_type' => 'location type',
            'marker_color'  => 'marker color',
        ];
    }

    /**
     * Custom error messages.
     */
    public function messages(): array
    {
        return [
            'latitude.between'  => 'Latitude must be between -90 and 90.',
            'longitude.between' => 'Longitude must be between -180 and 180.',
        ];
    }

    /**
     * Normalize input before validation runs.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
            'is_active'   => $this->boolean('is_active'),
            'sort_order'  => $this->input('sort_order', 0),
        ]);
    }
}