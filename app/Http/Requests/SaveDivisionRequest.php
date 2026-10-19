<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SaveDivisionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        if (! $this->filled('slug')) {
            $this->merge(['slug' => Str::slug((string) $this->input('name'), '_')]);
        }
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return ['name' => ['required', 'string', 'max:255'], 'sort_order' => ['required', 'integer', 'min:0', 'max:2147483647'], 'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:[_-][a-z0-9]+)*$/', Rule::unique('divisions')->ignore($this->route('division'))],
            'programme_group_id' => ['required', 'integer', 'exists:programme_groups,id'],
            'number' => ['required', 'integer', 'min:1', 'max:65535', Rule::unique('divisions')->ignore($this->route('division'))],
            'description' => ['nullable', 'string', 'max:10000'], 'cta_heading' => ['nullable', 'string', 'max:255'], 'cta_body' => ['nullable', 'string', 'max:10000'], 'is_published' => ['required', 'boolean'], 'detail_url' => ['nullable', 'string', 'max:255', 'regex:~^(?:/(?!/)[^\s\\\\]*|https?://[^\s\\\\]+)$~i'], ];
    }
}
