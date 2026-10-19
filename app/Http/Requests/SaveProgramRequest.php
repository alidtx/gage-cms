<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        return ['division_id' => ['required', 'integer', 'exists:divisions,id'],
            'position' => ['required', 'integer', 'min:1', 'max:65535', Rule::unique('programmes')->where('division_id', $this->input('division_id'))->ignore($this->route('program'))],
            'title' => ['required', 'string', 'max:255'], 'sort_order' => ['required', 'integer', 'min:0', 'max:2147483647'], 'is_published' => ['required', 'boolean'],
            'objectives' => ['present', 'array', 'max:100'], 'objectives.*' => ['required', 'string', 'max:2000'],
            'link_anchor' => ['nullable', 'string', 'max:255', 'regex:/^#?[a-zA-Z0-9_-]+$/'], 'link_url' => ['nullable', 'string', 'max:255', 'regex:~^(?:/(?!/)[^\s\\\\]*|https?://[^\s\\\\]+)$~i'], 'code' => ['nullable', 'string', 'max:255'], 'meta_line' => ['nullable', 'string', 'max:255'], 'duration' => ['nullable', 'string', 'max:255'], 'class_size' => ['nullable', 'string', 'max:255'], 'prerequisite' => ['nullable', 'string', 'max:255'], 'aim' => ['nullable', 'string', 'max:20000'], 'description' => ['nullable', 'string', 'max:20000'], 'participants' => ['nullable', 'string', 'max:20000'], ];
    }
}
