<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $seo['title'] }}</title>
<meta name="description" content="{{ $seo['description'] }}">
<link rel="canonical" href="{{ $seo['canonical'] }}">
@foreach(['keywords', 'author', 'publisher'] as $name)
    @if(filled($seo[$name]))<meta name="{{ $name }}" content="{{ $seo[$name] }}">@endif
@endforeach
@if(filled($seo['facebook_app_id']))<meta property="fb:app_id" content="{{ $seo['facebook_app_id'] }}">@endif
<meta property="og:type" content="{{ $seo['og_type'] }}">
<meta property="og:site_name" content="{{ $seo['site_name'] }}">
<meta property="og:title" content="{{ $seo['og_title'] }}">
<meta property="og:description" content="{{ $seo['og_description'] }}">
<meta property="og:url" content="{{ $seo['canonical'] }}">
<meta property="og:image" content="{{ $seo['og_image'] }}">
<meta property="og:image:alt" content="{{ $seo['og_title'] }}">
<meta name="twitter:card" content="{{ $seo['twitter_card'] }}">
<meta name="twitter:title" content="{{ $seo['twitter_title'] }}">
<meta name="twitter:description" content="{{ $seo['twitter_description'] }}">
<meta name="twitter:image" content="{{ $seo['twitter_image'] }}">
@if(filled($seo['twitter_site']))<meta name="twitter:site" content="{{ $seo['twitter_site'] }}">@endif
<link rel="stylesheet" href="{{ asset('styles.css') }}?v={{ filemtime(public_path('styles.css')) }}">
<link rel="stylesheet" href="{{ asset('frontend.css') }}?v={{ filemtime(public_path('frontend.css')) }}">
@stack('styles')
<script type="application/ld+json">{!! json_encode($seo['schema'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES | JSON_INVALID_UTF8_SUBSTITUTE) !!}</script>
@if($seo['gtm'])
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});
        var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
        j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer',{{ Illuminate\Support\Js::from($seo['gtm']) }});
    </script>
@elseif($seo['ga'])
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $seo['ga'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', {{ Illuminate\Support\Js::from($seo['ga']) }});
    </script>
@endif
