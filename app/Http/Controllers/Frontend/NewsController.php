<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Services\ArticleHtml;
use App\Services\FrontendHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NewsController extends Controller
{
    public function index(Request $request, FrontendHero $heroes): View
    {
        $filters = $request->validate(['category' => ['nullable', 'string', 'max:255']]);
        $category = ! empty($filters['category'])
            ? NewsCategory::where('is_active', true)->where('slug', $filters['category'])->firstOrFail()
            : null;
        $categories = NewsCategory::where('is_active', true)->orderBy('name')->get();
        $query = News::publiclyVisible()->with('category')
            ->when($category, fn ($query) => $query->where('news_category_id', $category->id));
        $featuredArticle = (clone $query)->where('is_featured', true)
            ->orderByDesc('published_at')->orderByDesc('id')->first();
        $articles = $query->when($featuredArticle, fn ($query) => $query->whereKeyNot($featuredArticle->id))
            ->orderByDesc('published_at')->orderByDesc('id')
            ->paginate(6)->appends($filters)->fragment('news-list');
        $pageSeo = [
            'title' => ($category ? $category->name.' news' : 'News & updates').' | GAGE',
            'canonical' => route('frontend.news', array_filter(['category' => $category?->slug, 'page' => $articles->currentPage() > 1 ? $articles->currentPage() : null])),
        ];

        $heroContent = $heroes->forPage('news');

        return view('frontend.pages.news', compact('categories', 'category', 'articles', 'featuredArticle', 'pageSeo', 'heroContent'));
    }

    public function show(string $slug, ArticleHtml $html): View
    {
        $article = News::publiclyVisible()->with(['category', 'author'])->where('slug', $slug)->firstOrFail();
        $content = $html->clean($article->content ?? '');
        $readingMinutes = max(1, (int) ceil(str_word_count(strip_tags($content)) / 200));
        $relatedArticles = News::publiclyVisible()->with('category')->whereKeyNot($article->id)
            ->where('news_category_id', $article->news_category_id)
            ->orderByDesc('published_at')->orderByDesc('id')->limit(3)->get();
        $previousArticle = News::publiclyVisible()
            ->where(function ($query) use ($article): void {
                $query->where('published_at', '<', $article->published_at)
                    ->orWhere(function ($query) use ($article): void {
                        $query->where('published_at', $article->published_at)->where('id', '<', $article->id);
                    });
            })->orderByDesc('published_at')->orderByDesc('id')->first();
        $pageSeo = [
            'title' => $article->meta_title ?: $article->title.' | GAGE',
            'description' => $article->meta_description ?: $article->excerpt,
            'canonical' => $article->canonical_url ?: route('frontend.news.show', $article->slug),
        ];

        return view('frontend.pages.news-show', compact('article', 'content', 'pageSeo', 'readingMinutes', 'relatedArticles', 'previousArticle'));
    }

    public function image(string $slug, string $type): StreamedResponse
    {
        abort_unless(in_array($type, ['featured', 'og'], true), 404);
        $article = News::publiclyVisible()->where('slug', $slug)->firstOrFail();
        $media = $type === 'featured' ? $article->featuredImage : $article->ogImage;
        abort_unless($media && $media->fileable_type === News::class && (int) $media->fileable_id === $article->id && Storage::exists($media->src), 404);
        $mime = Storage::mimeType($media->src);
        abort_unless(in_array($mime, ['image/jpeg', 'image/png', 'image/webp', 'image/gif'], true), 404);

        return Storage::response($media->src, null, ['Content-Type' => $mime, 'X-Content-Type-Options' => 'nosniff', 'Cache-Control' => 'no-cache']);
    }
}
