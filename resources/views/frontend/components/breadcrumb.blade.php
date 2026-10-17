@php
    $trail = array_merge([['label' => 'Home', 'url' => route('frontend.home')]], $parents ?? [], [['label' => $title, 'url' => url()->current()]]);
    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array_map(fn ($item, $index) => [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => $item['label'],
            'item' => $item['url'],
        ], $trail, array_keys($trail)),
    ];
@endphp
<nav aria-label="Breadcrumb" class="{{ $class ?? 'mb-10 text-xs leading-6 text-white/70' }}">
    <ol class="flex flex-wrap items-center gap-2">
        @foreach($trail as $item)
            <li class="inline-flex items-center gap-2">
                @unless($loop->first)<span aria-hidden="true">›</span>@endunless
                @if($loop->last)
                    <span aria-current="page" class="font-bold text-white">{{ $item['label'] }}</span>
                @else
                    <a href="{{ $item['url'] }}" class="hover:underline">{{ $item['label'] }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_SLASHES) !!}</script>
