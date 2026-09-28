<?php

namespace App\Http\Requests;

use App\Services\SiteMapService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiteMapRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'settings' => ['required', 'array', 'min:1', 'max:5'],
            'settings.*' => ['required', 'array:content_type,include,priority,change_frequency'],
            'settings.*.content_type' => ['required', 'string', 'distinct', Rule::in(array_keys(SiteMapService::DEFAULTS))],
            'settings.*.include' => ['required', 'boolean'],
            'settings.*.priority' => ['required', 'numeric', 'between:0,1', 'multiple_of:0.1'],
            'settings.*.change_frequency' => ['required', Rule::in(['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'])],
        ];
    }
}
