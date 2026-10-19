@php
    [$accent, $tint] = match ($theme ?? 'security') {
        'fire-safety' => ['#c61026', '#f8dfe3'],
        'technology' => ['#197379', '#e0edef'],
        default => ['#000000', '#f3f4f6'],
    };
@endphp
<div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
    @foreach($services as $service)
        @php
            $link = $service->link;
            $safeLink = is_string($link) && preg_match('~^(?:/(?!/)[^\\s\\\\]*|https?://[^\\s\\\\]+)$~i', $link);
        @endphp
        <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] bg-white p-8">
            @if($service->media?->name === 'Service SVG Icon')
                <span class="icon-box" style="background-color: {{ $tint }}; color: {{ $accent }};">
                    <span aria-hidden="true" style="display:block;width:26px;height:26px;background-color:currentColor;mask:url('{{ route('frontend.service-icon', $service) }}') center / contain no-repeat;-webkit-mask:url('{{ route('frontend.service-icon', $service) }}') center / contain no-repeat;"></span>
                </span>
            @endif
            <h3 class="mt-7 text-xl font-bold">{{ $service->title }}</h3>
            <p class="mt-3 flex-1 text-base leading-7 text-muted">{{ $service->description }}</p>
            @if($safeLink)
                <a href="{{ $link }}" class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold" style="color: {{ $accent }};">View service<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" /></svg></a>
            @endif
        </article>
    @endforeach
</div>
