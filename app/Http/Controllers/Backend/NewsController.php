<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveNewsRequest;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use App\Services\NewsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Inertia\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NewsController extends Controller
{
    public function index(Request $request): Response
    {
        return $this->page($request);
    }

    public function edit(Request $request, News $news): Response
    {
        return $this->page($request, $news);
    }

    private function page(Request $request, ?News $news = null): Response
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', Rule::in(['draft', 'published', 'archived'])],
            'category' => ['nullable', 'integer', Rule::exists('news_categories', 'id')],
            'featured' => ['nullable', 'boolean'],
        ]);
        $query = News::with(['category:id,name', 'author:id,name'])
            ->select(['id', 'title', 'news_category_id', 'author_id', 'published_at', 'status', 'is_featured']);
        if (! empty($filters['search'])) {
            $query->where('title', 'like', '%'.$filters['search'].'%');
        }
        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }
        if (! empty($filters['category'])) {
            $query->where('news_category_id', $filters['category']);
        }
        if (isset($filters['featured'])) {
            $query->where('is_featured', $filters['featured']);
        }

        return Inertia::render('Backend/News/Index', [
            'articles' => $query->orderByDesc('id')->paginate(10)->withQueryString(),
            'categories' => NewsCategory::orderBy('name')->get(['id', 'name', 'is_active']),
            'authors' => User::orderBy('name')->get(['id', 'name']),
            'filters' => $filters,
            'article' => $news ? [
                ...$news->toArray(),
                'published_at' => $news->published_at?->format('Y-m-d\TH:i'),
                'featured_image_url' => $news->featured_image_id ? route('backend.news.image', [$news, 'featured'], false) : null,
                'og_image_url' => $news->og_image_id ? route('backend.news.image', [$news, 'og'], false) : null,
            ] : null,
        ]);
    }

    public function store(SaveNewsRequest $request, NewsService $service): RedirectResponse
    {
        $service->save(new News, $request->validated());

        return to_route('backend.news.index');
    }

    public function update(SaveNewsRequest $request, News $news, NewsService $service): RedirectResponse
    {
        $service->save($news, $request->validated());

        return to_route('backend.news.index');
    }

    public function destroy(News $news, NewsService $service): RedirectResponse
    {
        $service->delete($news);

        return to_route('backend.news.index');
    }

    public function image(News $news, string $type): StreamedResponse
    {
        abort_unless(in_array($type, ['featured', 'og'], true), 404);
        $media = $type === 'featured' ? $news->featuredImage : $news->ogImage;
        abort_unless($media && Storage::exists($media->src), 404);

        return Storage::response($media->src, null, ['Cache-Control' => 'no-store, private']);
    }
}
