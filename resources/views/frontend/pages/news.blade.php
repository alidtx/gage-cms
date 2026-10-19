@extends('frontend.layouts.app')
@section('content')
    @include('frontend.components.hero', [
        'hero' => \App\Services\FrontendHero::merge([
            'variant' => 'text',
            'section_class' => 'bg-black text-white',
            'container_class' => 'container pb-[140px] pt-10',
            'heading_class' => 'mt-7 text-[42px] font-bold leading-[1.12] tracking-[-1px] sm:text-[56px]',
            'heading' => [['text' => 'News & updates.']],
            'description' => 'Announcements, events and stories from across the GAGE companies.',
            'description_class' => 'mt-6 text-lg leading-[1.7] text-[#b9bec4]',
            'eyebrow' => 'NEWS',
            'eyebrow_class' => 'eyebrow',
            'breadcrumb' => ['title' => 'News', 'class' => 'mb-10 flex gap-3 text-xs text-[#b9bec4]'],
        ], $heroContent),
    ])
    <section id="news-list" class="news-listing container pb-[120px] pt-16">
        <nav class="mb-14 flex flex-wrap gap-3" aria-label="News categories">
            <a class="news-filter-label" href="{{ route('frontend.news') }}#news-list"
                @if (!$category) aria-current="page" @endif>All</a>
            @foreach ($categories as $item)
                <a class="news-filter-label" href="{{ route('frontend.news', ['category' => $item->slug]) }}"
                    @if ($category?->id === $item->id) aria-current="page" @endif>{{ $item->name }}</a>
            @endforeach
        </nav>
        @if ($featuredArticle)
            <article class="public-news-featured">
                <a href="{{ route('frontend.news.show', $featuredArticle->slug) }}"
                    aria-label="{{ $featuredArticle->title }}">
                    @if ($featuredArticle->featured_image_id)
                        <img class="public-news-image"
                            src="{{ route('frontend.news.image', [$featuredArticle->slug, 'featured']) }}"
                            alt="{{ $featuredArticle->title }}">
                    @else
                        <div class="public-news-image public-news-placeholder" aria-hidden="true">GAGE NEWS</div>
                    @endif
                </a>
                <div>
                    <p class="text-xs font-extrabold tracking-wide">● FEATURED · {{ $featuredArticle->category->name }} ·
                        <time
                            datetime="{{ $featuredArticle->published_at->toDateString() }}">{{ $featuredArticle->published_at->format('d F Y') }}</time>
                    </p>
                    <h2 class="featured-news-title"><a
                            href="{{ route('frontend.news.show', $featuredArticle->slug) }}">{{ $featuredArticle->title }}</a>
                    </h2>
                    <p class="mt-6 text-base leading-7 text-muted">{{ mb_substr($featuredArticle->excerpt ?? '', 0, 300) }}{{ mb_strlen($featuredArticle->excerpt ?? '') > 300 ? '…' : '' }}</p>
                    <a class="button mt-8 bg-black text-white"
                        href="{{ route('frontend.news.show', $featuredArticle->slug) }}">Read article →</a>
                </div>
            </article>
        @endif
        <div class="public-news-grid {{ $featuredArticle ? 'mt-16' : '' }}">
            @forelse($articles as $article)
                <article class="public-news-card">
                    <a href="{{ route('frontend.news.show', $article->slug) }}" aria-label="{{ $article->title }}">
                        @if ($article->featured_image_id)
                            <img src="{{ route('frontend.news.image', [$article->slug, 'featured']) }}"
                                alt="{{ $article->title }}" class="public-news-image" loading="lazy">
                        @else
                            <div class="public-news-image public-news-placeholder" aria-hidden="true">GAGE NEWS</div>
                        @endif
                    </a>
                    <div>
                        <p class="mt-6 text-xs font-extrabold tracking-wide">● {{ $article->category->name }} · <time
                                datetime="{{ $article->published_at->toDateString() }}">{{ $article->published_at->format('d M Y') }}</time>
                        </p>
                        <h2 class="!mt-4 !text-xl !leading-[1.4] !tracking-normal"><a
                                href="{{ route('frontend.news.show', $article->slug) }}">{{ $article->title }}</a></h2>
                        <p class="mt-3 text-sm leading-6 text-muted">{{ mb_substr($article->excerpt ?? '', 0, 300) }}{{ mb_strlen($article->excerpt ?? '') > 300 ? '…' : '' }}</p>
                        <a class="mt-6 inline-flex text-sm font-bold"
                            href="{{ route('frontend.news.show', $article->slug) }}">Read more →</a>
                    </div>
                </article>
            @empty
                @if (!$featuredArticle)
                    <p class="text-muted">No published news{{ $category ? ' in ' . $category->name : '' }} yet.</p>
                @endif
            @endforelse
        </div>
        @if ($articles->hasPages())
            <nav class="news-pagination mt-20 flex justify-center gap-3" aria-label="News pagination">
                @if ($articles->previousPageUrl())
                    <a href="{{ $articles->previousPageUrl() }}">← Previous</a>
                @endif
                <span aria-current="page">Page {{ $articles->currentPage() }} of {{ $articles->lastPage() }}</span>
                @if ($articles->nextPageUrl())
                    <a href="{{ $articles->nextPageUrl() }}">Next →</a>
                @endif
            </nav>
        @endif
    </section>
    <section id="contact" class="container pb-[120px]">
        <div
            class="flex flex-col justify-between gap-9 rounded-[24px] bg-black px-9 py-16 text-white lg:flex-row lg:items-center lg:px-16">
            <div>
                <h2 class="!mt-0">Get Protected Now.</h2>
                <p class="mt-4 max-w-[740px] text-base leading-7 text-[#b9bec4]">Tell us what you need to protect.
                    Our team will recommend the right mix of security,<br class="hidden xl:block"> fire safety,
                    training and technology — and give you a clear proposal.</p>
            </div>
            <div class="flex min-w-[290px] flex-col gap-3">
                <a href="{{ route('contact.create') }}" class="button button-light">Request a
                    quote<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-arrow-right">
                        <path d="M5 12h14">
                        </path>
                        <path d="m12 5 7 7-7 7">
                        </path>
                    </svg>
                </a>
                <a class="button button-outline justify-between" href="tel:+9603304055">Call +960 330 4055<svg
                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-phone">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
