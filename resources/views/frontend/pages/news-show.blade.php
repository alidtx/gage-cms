@extends('frontend.layouts.app')
@section('content')
    <article class="news-detail">
        <div class="container pt-10">
            @include('frontend.components.breadcrumb', ['title' => $article->title, 'parents' => [['label' => 'News', 'url' => route('frontend.news')]], 'class' => 'news-detail-breadcrumb text-xs leading-6 text-muted'])
        </div>
        <header class="article-column pb-10 pt-12">
            <p class="text-xs font-extrabold tracking-wide">● {{ $article->category->name }} · <time datetime="{{ $article->published_at->toDateString() }}">{{ $article->published_at->format('d F Y') }}</time> · {{ $readingMinutes }} MIN READ</p>
            <h1 class="mt-7 text-[38px] font-bold leading-[1.12] tracking-[-1px] sm:text-[56px]">{{ $article->title }}</h1>
            @if($article->excerpt)<p class="mt-7 text-xl leading-[1.65] text-[#494f58]">{{ $article->excerpt }}</p>@endif
            <div class="article-share mt-8" aria-label="Share this article">
                <span class="text-sm font-bold">Share</span>
                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ rawurlencode(route('frontend.news.show', $article->slug)) }}" target="_blank" rel="noopener noreferrer" aria-label="Share article on LinkedIn">in</a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode(route('frontend.news.show', $article->slug)) }}" target="_blank" rel="noopener noreferrer" aria-label="Share article on Facebook">f</a>
                <button type="button" data-copy-article="{{ route('frontend.news.show', $article->slug) }}" aria-label="Copy article link">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-2 2M14 11a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l2-2"/></svg>
                </button>
                <span data-copy-status class="text-sm" aria-live="polite"></span>
            </div>
        </header>
        @if($article->featured_image_id)
            <figure class="container">
                <img class="news-detail-cover" src="{{ route('frontend.news.image', [$article->slug, 'featured']) }}" alt="{{ $article->title }}" fetchpriority="high" decoding="async">
            </figure>
        @endif
        <div id="article-content" class="article-column pb-24 pt-14">
            <div class="article-copy article-content">{!! $content !!}</div>
            @if($previousArticle)
                <nav aria-label="Previous article" class="mt-16 border-t border-[#dfe2e7] pt-7">
                    <p class="text-xs text-muted">PREVIOUS</p>
                    <a class="mt-3 inline-flex text-sm font-bold" href="{{ route('frontend.news.show', $previousArticle->slug) }}">{{ $previousArticle->title }}</a>
                </nav>
            @endif
        </div>
    </article>
    @if($relatedArticles->isNotEmpty())
        <section class="bg-[#f4f5f7]">
            <div class="container section">
                <p class="eyebrow"><span></span>MORE NEWS</p>
                <h2>Related articles</h2>
                <div class="mt-12 grid gap-8 md:grid-cols-3">
                    @foreach($relatedArticles as $related)
                        <article>
                            <a href="{{ route('frontend.news.show', $related->slug) }}" aria-label="{{ $related->title }}">
                                @if($related->featured_image_id)
                                    <img class="public-news-image" src="{{ route('frontend.news.image', [$related->slug, 'featured']) }}" alt="{{ $related->title }}" loading="lazy">
                                @else
                                    <div class="public-news-image public-news-placeholder" aria-hidden="true">GAGE NEWS</div>
                                @endif
                            </a>
                            <p class="mt-6 text-xs font-extrabold tracking-wide">● {{ $related->category->name }} · {{ $related->published_at->format('d F Y') }}</p>
                            <h3 class="mt-4 text-xl font-bold leading-[1.4]"><a href="{{ route('frontend.news.show', $related->slug) }}">{{ $related->title }}</a></h3>
                            <a class="mt-7 inline-flex text-sm font-bold" href="{{ route('frontend.news.show', $related->slug) }}">Read more →</a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <section class="container py-[120px]">
        <div class="rounded-[24px] bg-black px-9 py-16 text-white">
            <h2 class="!mt-0">Get Protected Now.</h2>
            <p class="mt-4 text-base leading-7 text-[#b9bec4]">Tell us what you need to protect. Our team will recommend the right mix of security, fire safety, training and technology.</p>
            <div class="mt-7 flex flex-wrap gap-3">
                <a class="button button-light" href="{{ route('contact.create') }}">Request a quote →</a>
                <a class="button button-outline" href="tel:+9603304055">Call +960 330 4055</a>
            </div>
        </div>
    </section>
@endsection
