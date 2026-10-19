<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SaveProgrammeGroupRequest extends FormRequest
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
        return ['name' => ['required', 'string', 'max:255'], 'sort_order' => ['required', 'integer', 'min:0', 'max:2147483647'], 'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:[_-][a-z0-9]+)*$/', Rule::unique('programme_groups')->ignore($this->route('programmeGroup'))]];
    }
}
