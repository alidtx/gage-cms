@if($entities->isNotEmpty())
    <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        @foreach($entities as $entity)
            @php
                $color = match ($entity->category) {
                    'safety' => '#c61026',
                    'training' => '#4800cc',
                    'consulting', 'marine' => '#197379',
                    'retail' => '#442424',
                    default => '#000000',
                };
                $link = $entity->meta['link'] ?? null;
                $safeLink = is_string($link) && preg_match('~^(?:/(?!/)[^\\s\\\\]*|https?://[^\\s\\\\]+)$~i', $link);
            @endphp
            <article class="company-card overflow-hidden rounded-[14px] border border-[#dfe2e7] ZoomOutAnimation" style="display: flex; flex-direction: column;">
                <div class="flex h-[184px] items-center justify-center" style="background-color: {{ $color }}; flex-shrink: 0;">
                    @if($entity->media)
                        <img width="302" height="184" decoding="async" loading="lazy" alt="{{ $entity->name }}" class="h-full w-full object-cover" src="{{ route('frontend.entity-image', $entity) }}">
                    @else
                        <span class="p-6 text-white font-bold">{{ $entity->name }}</span>
                    @endif
                </div>
                <div class="p-6" style="display: flex; flex-direction: column; flex: 1;">
                    <p class="min-h-[130px] text-sm leading-[1.65] text-muted">{{ $entity->short_description }}</p>
                    @if($safeLink)
                        <a class="mt-5 inline-flex items-center gap-2 text-sm font-bold" href="{{ $link }}" style="color: {{ $color }};">
                            {{ $entity->name }}
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" /></svg>
                        </a>
                    @else
                        <span class="mt-5 text-sm font-bold" style="color: {{ $color }};">{{ $entity->name }}</span>
                    @endif
                </div>
            </article>
        @endforeach
    </div>
@endif
