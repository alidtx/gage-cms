<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rule;

class SaveServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'file', 'max:64', function (string $attribute, mixed $value, \Closure $fail): void {
                if (! $value instanceof UploadedFile || ! $value->isValid()) {
                    return;
                }
                $svg = $value->get();
                $previous = libxml_use_internal_errors(true);
                try {
                    $document = new \DOMDocument;
                    if (preg_match('/<!DOCTYPE|<!ENTITY/i', $svg) || ! $document->loadXML($svg, LIBXML_NONET) || $document->documentElement?->localName !== 'svg') {
                        $fail('Upload a valid SVG icon.');

                        return;
                    }
                    $allowed = ['svg', 'g', 'path', 'circle', 'ellipse', 'rect', 'line', 'polyline', 'polygon', 'title', 'desc', 'defs', 'clipPath', 'mask', 'linearGradient', 'radialGradient', 'stop'];
                    foreach ($document->getElementsByTagName('*') as $element) {
                        if (! in_array($element->localName, $allowed, true)) {
                            $fail('Use a static SVG icon without scripts, styles or embedded content.');

                            return;
                        }
                        foreach ($element->attributes as $attribute) {
                            if (str_starts_with(strtolower($attribute->localName), 'on') || in_array(strtolower($attribute->localName), ['href', 'style'], true) || preg_match('/url\\(\\s*["\']?(?!#)/i', $attribute->value)) {
                                $fail('SVG icons cannot contain scripts or external references.');

                                return;
                            }
                        }
                    }
                } finally {
                    libxml_clear_errors();
                    libxml_use_internal_errors($previous);
                }
            }],
            'link' => ['nullable', 'string', 'max:2048', 'regex:~^(?:/(?!/)[^\\s\\\\]*|https?://[^\\s\\\\]+)$~i'],
            'description' => ['nullable', 'string', 'max:160'],
            'entity_id' => ['required', 'integer', Rule::exists('entities', 'id')->whereNull('deleted_at')],
        ];
    }
}
