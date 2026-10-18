@extends('frontend.layouts.app')
@section('content')
    @include('frontend.components.hero', ['hero' => [
        'heading' => [['text' => $article->title]],
        'description' => $article->excerpt,
        'eyebrow' => $article->category->name,
        'breadcrumb' => ['title' => $article->title, 'parents' => [['label' => 'News', 'url' => route('frontend.news')]]],
    ]])
    <article class="container section public-news-article">
        <p class="text-sm text-muted"><time datetime="{{ $article->published_at->toDateString() }}">{{ $article->published_at->format('d F Y') }}</time>@if($article->author) · {{ $article->author->name }}@endif</p>
        @if($article->featured_image_id)
            <img class="public-news-image mt-6" src="{{ route('frontend.news.image', [$article->slug, 'featured']) }}" alt="{{ $article->title }}">
        @endif
        <div class="article-content">{!! $content !!}</div>
        <a class="button mt-10" href="{{ route('frontend.news', ['category' => $article->category->slug]) }}">More {{ $article->category->name }} news</a>
    </article>
@endsection
