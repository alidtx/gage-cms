@php
    $variant = $hero['variant'] ?? 'text';
    $isSplit = in_array($variant, ['home', 'split'], true) && (!empty($hero['image']) || !empty($hero['video']));
    $containerClass = $hero['container_class'] ?? ($variant === 'home' ? 'container py-16' : 'container pb-20 pt-10');
    $gridClass = $hero['grid_class'] ?? 'grid items-center gap-12 lg:grid-cols-2 lg:gap-24';
    // The home variant historically places its grid on the container itself.
    $containerIsGrid = str_contains($containerClass, 'grid');
@endphp
<section class="{{ $hero['section_class'] ?? 'bg-black text-white' }}">
    <div class="{{ $containerClass }}">
        @if(!empty($hero['breadcrumb']))
            @include('frontend.components.breadcrumb', $hero['breadcrumb'])
        @endif
        @if($isSplit && !$containerIsGrid)<div class="{{ $gridClass }}">@endif
        <div>
            @if(!empty($hero['logo']))
                <img src="{{ asset($hero['logo']['src']) }}" alt="{{ $hero['logo']['alt'] ?? '' }}" class="w-[170px]" decoding="async">
            @endif
            @if(!empty($hero['eyebrow']))
                <p class="{{ $hero['eyebrow_class'] ?? 'eyebrow' }}"><span aria-hidden="true"></span>{{ $hero['eyebrow'] }}</p>
            @endif
            <h1 class="{{ $hero['heading_class'] ?? 'mt-6 text-[40px] font-bold leading-[1.12] sm:text-[56px]' }}">@foreach($hero['heading'] as $line){{ $line['text'] }}@if(!$loop->last)<br class="{{ $line['break_class'] ?? '' }}"> @endif
            @endforeach</h1>
            @if(!empty($hero['description']))
                <p class="{{ $hero['description_class'] ?? 'mt-6 text-lg leading-[1.7] text-white/80' }}">{{ $hero['description'] }}</p>
            @endif
            @if(!empty($hero['buttons']))
                <div class="{{ $variant === 'home' ? 'mt-10' : 'mt-9' }} flex flex-wrap gap-3">
                    @foreach($hero['buttons'] as $button)
                        <a href="{{ str_starts_with($button['url'], '/') ? url($button['url']) : $button['url'] }}" class="{{ $button['class'] ?? 'button button-light' }}">
                            {{ $button['label'] }}
                            @if(($button['arrow'] ?? 'yes') === 'yes')
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" /></svg>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endif
            @if(!empty($hero['trust_badges']))
                <ul class="mt-6 flex flex-wrap gap-4">@foreach($hero['trust_badges'] as $badge)<li>{{ $badge }}</li>@endforeach</ul>
            @endif
        </div>
        @if(!empty($hero['video']) && $variant === 'home')
            <video class="aspect-[1.05] w-full rounded-[20px] object-cover" autoplay muted controls playsinline preload="auto" aria-label="Hero video" @if(!empty($hero['image'])) poster="{{ asset($hero['image']['src']) }}" @endif>
                <source src="{{ $hero['video'] }}">
                <a href="{{ $hero['video'] }}">Watch video</a>
            </video>
        @elseif(!empty($hero['image']))
            <img src="{{ asset($hero['image']['src']) }}" alt="{{ $hero['image']['alt'] ?? '' }}"
                class="{{ $hero['image']['class'] ?? 'aspect-[1.05] w-full rounded-[16px] object-cover' }}"
                decoding="async" fetchpriority="high"
                @if(isset($hero['image']['width'])) width="{{ $hero['image']['width'] }}" height="{{ $hero['image']['height'] }}" @endif>
        @endif
        @if($isSplit && !$containerIsGrid)</div>@endif
    </div>
</section>
