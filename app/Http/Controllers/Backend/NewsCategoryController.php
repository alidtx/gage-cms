<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveNewsCategoryRequest;
use App\Models\NewsCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;

class NewsCategoryController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Backend/NewsCategory/Index', [
            'categories' => NewsCategory::with('parent:id,name')->withCount('articles')->orderBy('name')->get(),
        ]);
    }

    public function store(SaveNewsCategoryRequest $request): RedirectResponse
    {
        NewsCategory::create($request->validated());

        return to_route('backend.news-category.index');
    }

    public function update(SaveNewsCategoryRequest $request, NewsCategory $newsCategory): RedirectResponse
    {
        $newsCategory->update($request->validated());

        return to_route('backend.news-category.index');
    }

    public function destroy(NewsCategory $newsCategory): RedirectResponse
    {
        if ($newsCategory->articles()->exists() || $newsCategory->children()->exists()) {
            throw ValidationException::withMessages([
                'category' => 'Move this category’s articles and child categories before deleting it.',
            ]);
        }

        $newsCategory->delete();

        return to_route('backend.news-category.index');
    }
}
