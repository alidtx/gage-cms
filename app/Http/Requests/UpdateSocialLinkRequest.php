<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'facebook'  => ['nullable', 'url', 'max:255'],
            'linkedin'  => ['nullable', 'url', 'max:255'],
            'youtube'   => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'whatsapp'  => ['nullable', 'string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'facebook'  => 'Facebook URL',
            'linkedin'  => 'LinkedIn URL',
            'youtube'   => 'YouTube URL',
            'instagram' => 'Instagram URL',
            'whatsapp'  => 'WhatsApp number',
        ];
    }

    public function messages(): array
    {
        return [
            '*.url' => 'The :attribute must be a valid URL (e.g. https://example.com).',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge(collect([
            'facebook', 'linkedin', 'youtube', 'instagram', 'whatsapp',
        ])->mapWithKeys(fn ($field) => [
            $field => $this->filled($field) ? trim($this->input($field)) : null,
        ])->all());
    }
}