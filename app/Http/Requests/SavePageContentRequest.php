<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SavePageContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    protected function prepareForValidation(): void
    {
        if (! $this->filled('slug')) {
            $name = $this->input('name');
            $this->merge(['slug' => is_string($name) ? Str::slug($name) : '']);
        }
        foreach (['content', 'meta'] as $field) {
            if (is_string($this->input($field))) {
                $decoded = json_decode($this->input($field), true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $this->merge([$field => $decoded]);
                }
            }
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('page_contents', 'page')->ignore($this->route('pageContent'))],
            'is_active' => ['sometimes', 'boolean'],
            'is_featured' => ['sometimes', 'boolean'],
            'sort_order' => ['sometimes', 'integer', 'min:0', 'max:2147483647'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:5120'],
            'hero_video' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm', 'max:20480'],
            'remove_hero_video' => ['sometimes', 'boolean'],
            'content' => ['nullable', 'array'],
            'content.map' => ['sometimes', 'array:name,address,embed_url,directions_url'],
            'content.map.name' => ['nullable', 'string', 'max:255'],
            'content.map.address' => ['nullable', 'string', 'max:1000'],
            'content.map.embed_url' => ['nullable', 'url:https', 'max:5000', 'regex:~^https://(?:www\.)?google\.com/maps/embed(?:\?|/)[^\s]*$~'],
            'content.map.directions_url' => ['nullable', 'url:https', 'max:2048'],
            'content.faqs' => ['sometimes', 'array', 'max:100'],
            'content.faqs.*' => ['array'],
            'content.faqs.*.question' => ['required', 'string', 'max:1000'],
            'content.faqs.*.answer' => ['required', 'string', 'max:10000'],
            'content.hero' => ['sometimes', 'array'],
            'content.hero.badge' => ['sometimes', 'array'],
            'content.hero.primary_cta' => ['sometimes', 'array'],
            'content.hero.trust_badges' => ['sometimes', 'array'],
            'content.hero.trust_badges.*' => ['string', 'max:255'],
            'content.sections' => ['sometimes', 'array', 'max:100'],
            'content.sections.*' => ['array'],
            'content.sections.*.items' => ['sometimes', 'array', 'max:100'],
            'content.sections.*.items.*' => ['array'],
            'content.team' => ['sometimes', 'array', 'max:100'],
            'content.team.*' => ['array'],
            'content.team.*.tags' => ['sometimes', 'array'],
            'content.team.*.tags.*' => ['string', 'max:255'],
            'content.partners' => ['sometimes', 'array', 'max:100'],
            'content.partners.*' => ['array'],
            'content.contact' => ['sometimes', 'array'],
            'content.contact.email' => ['nullable', 'email', 'max:255'],
            'meta' => ['nullable', 'array'],
            'meta.*' => ['nullable', 'string', 'max:2000'],
            'meta.primary_color' => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'meta.secondary_color' => ['nullable', 'regex:/^#[0-9a-fA-F]{6}$/'],
        ];
    }

    /** @return array<string, mixed> */
    public function pageData(): array
    {
        $data = $this->validated();
        // Keep custom JSON sections after validating the structures used by the editor.
        foreach (['content', 'meta'] as $field) {
            if ($this->has($field)) {
                $data[$field] = $this->input($field);
            }
        }

        return $data;
    }
}
