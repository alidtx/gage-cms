<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SavePageContentRequest;
use App\Models\PageContent;
use App\Services\PageContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PageContentController extends Controller
{
    public function index(Request $request): Response
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
        ]);
        $query = PageContent::query();
        if (! empty($filters['search'])) {
            $query->where(function ($query) use ($filters): void {
                $query->where('name', 'like', '%'.$filters['search'].'%')
                    ->orWhere('page', 'like', '%'.$filters['search'].'%');
            });
        }

        return Inertia::render('Backend/PageContent/Index', [
            'pages' => $query->orderBy('sort_order')->orderBy('name')->paginate(12)->withQueryString()->through(fn (PageContent $pageContent) => $this->data($pageContent)),
            'filters' => $filters,
            'stats' => [
                'total' => PageContent::count(),
                'active' => PageContent::where('is_active', true)->count(),
                'featured' => PageContent::where('is_featured', true)->count(),
                'inactive' => PageContent::where('is_active', false)->count(),
            ],
        ]);
    }

    public function edit(PageContent $pageContent): Response
    {
        return Inertia::render('Backend/PageContent/Edit', [
            'pageContent' => $this->data($pageContent),
        ]);
    }

    private function data(PageContent $pageContent): array
    {
        return [
            ...$pageContent->toArray(),
            'name' => $pageContent->name ?? $pageContent->page,
            'slug' => $pageContent->page,
            'image_url' => $pageContent->media_id ? route('backend.pages.image', $pageContent, false).'?v='.$pageContent->media_id : null,
        ];
    }

    public function store(SavePageContentRequest $request, PageContentService $service): RedirectResponse
    {
        $pageContent = new PageContent;
        $service->save($pageContent, $request->pageData());

        return to_route('backend.pages.edit', $pageContent);
    }

    public function update(SavePageContentRequest $request, PageContent $pageContent, PageContentService $service): RedirectResponse
    {
        $service->save($pageContent, $request->pageData());

        return to_route('backend.pages.edit', $pageContent);
    }

    public function toggleActive(PageContent $pageContent): RedirectResponse
    {
        $pageContent->update(['is_active' => ! $pageContent->is_active]);

        return back();
    }

    public function destroy(PageContent $pageContent, PageContentService $service): RedirectResponse
    {
        $service->delete($pageContent);

        return to_route('backend.pages.index');
    }

    public function image(PageContent $pageContent): StreamedResponse
    {
        $media = $pageContent->media;
        abort_unless($media && Storage::exists($media->src), 404);

        return Storage::response($media->src, null, ['Cache-Control' => 'no-store, private']);
    }
}
