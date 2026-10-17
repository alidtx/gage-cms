<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'GAGE | Experts in Safety & Security')</title>
<meta name="description" content="@yield('description', 'Security, fire safety, training and technology across the Maldives from GAGE.')">
<link rel="canonical" href="@yield('canonical', url()->current())">
<meta property="og:type" content="website">
<meta property="og:site_name" content="GAGE">
<meta property="og:title" content="@yield('title', 'GAGE | Experts in Safety & Security')">
<meta property="og:description" content="@yield('description', 'Security, fire safety, training and technology across the Maldives from GAGE.')">
<meta property="og:url" content="@yield('canonical', url()->current())">
<meta property="og:image" content="{{ asset('assets/pdf-1.jpg') }}">
<meta property="og:image:alt" content="GAGE security professional at a Maldives resort">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="@yield('title', 'GAGE | Experts in Safety & Security')">
<meta name="twitter:description" content="@yield('description', 'Security, fire safety, training and technology across the Maldives from GAGE.')">
<meta name="twitter:image" content="{{ asset('assets/pdf-1.jpg') }}">
<link rel="stylesheet" href="{{ asset('styles.css') }}?v={{ filemtime(public_path('styles.css')) }}">
<link rel="stylesheet" href="{{ asset('frontend.css') }}?v={{ filemtime(public_path('frontend.css')) }}">
@stack('styles')
<script type="application/ld+json">{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'GAGE Private Limited',
    'url' => route('frontend.home'),
    'logo' => asset('assets/logo.png'),
    'telephone' => '+9603304055',
    'email' => 'info@gage.com.mv',
    'sameAs' => ['https://www.linkedin.com/company/gage-private-limited/', 'https://www.facebook.com/gage.mv/', 'https://www.instagram.com/gage.mv/'],
], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES) !!}</script>
