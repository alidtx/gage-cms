<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.partials.head')
</head>
<body>
    @if($seo['gtm'])
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $seo['gtm'] }}" height="0" width="0" style="display:none;visibility:hidden" title="Google Tag Manager"></iframe></noscript>
    @endif
    <a href="#main-content" class="skip-link">Skip to content</a>
    @include('frontend.partials.header')
    <main id="main-content" tabindex="-1">
        @yield('content')
    </main>
    @include('frontend.partials.footer')
    @include('frontend.partials.scripts')
</body>
</html>
