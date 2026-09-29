<?php

namespace App\Http\Requests;

use App\Models\NewsCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class SaveNewsCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', Rule::unique('news_categories')->ignore($this->route('newsCategory'))],
            'parent_id' => ['nullable', 'integer', Rule::exists('news_categories', 'id')],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function after(): array
    {
        return [function (Validator $validator): void {
            $category = $this->route('newsCategory');
            if ($validator->errors()->isNotEmpty() || ! $category || ! $this->filled('parent_id')) {
                return;
            }

            $parents = NewsCategory::pluck('parent_id', 'id');
            $parentId = (int) $this->input('parent_id');
            $visited = [];
            while ($parentId) {
                if ($parentId === $category->id || isset($visited[$parentId])) {
                    $validator->errors()->add('parent_id', 'A category cannot be its own parent or a descendant of itself.');

                    return;
                }
                $visited[$parentId] = true;
                $parentId = $parents->get($parentId);
            }
        }];
    }
}
