<?php

namespace App\Http\Requests;

use App\Models\Entity;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SaveEntityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        if (! $this->filled('slug')) {
            $name = $this->input('name');
            $this->merge(['slug' => is_string($name) ? Str::slug($name, '_') : '']);
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:[-_][a-z0-9]+)*$/', Rule::unique('entities')->ignore($this->route('entity'))],
            'category' => ['required', Rule::in(Entity::CATEGORIES)],
            'short_description' => ['nullable', 'string', 'max:140'],
            'link' => ['nullable', 'string', 'max:2048', 'regex:~^(?:/(?!/)[^\\s\\\\]*|https?://[^\\s\\\\]+)$~i'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
        ];
    }

    /** @return array<string, mixed> */
    public function entityData(): array
    {
        return $this->validated();
    }
}
