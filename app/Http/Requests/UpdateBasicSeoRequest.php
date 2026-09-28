<?php
// app/Http/Requests/UpdateBasicSeoRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBasicSeoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'               => ['nullable', 'string', 'max:255'],
            'meta_description'    => ['nullable', 'string', 'max:500'],
            'keywords'            => ['nullable', 'string', 'max:500'],

            'og_title'            => ['nullable', 'string', 'max:255'],
            'og_type'             => ['nullable', 'string', 'in:website,article,product,service,video'],
            'og_description'      => ['nullable', 'string', 'max:500'],

            'media_id'            => ['nullable', 'integer', 'exists:media,id'],
            'canonical_url'       => ['nullable', 'url', 'max:255'],

            'schema_type'         => ['nullable', 'string', 'max:50'],
            'custom_schema'       => ['nullable'],

            'twitter_title'       => ['nullable', 'string', 'max:255'],
            'twitter_card_type'   => ['nullable', 'string', 'in:summary,summary_large_image,app,player'],
            'twitter_description' => ['nullable', 'string', 'max:500'],
        ];
    }
}