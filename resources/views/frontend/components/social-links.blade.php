@php
    $iconSize = max(12, min(48, (int) ($size ?? 15)));
    $isDark = ($theme ?? 'dark') === 'dark';
@endphp
@if(!empty($links))
<nav aria-label="{{ $label ?? 'Social media' }}" class="flex flex-wrap gap-3 {{ $class ?? '' }}">
    @foreach($links as $platform => $link)
        <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $link['label'] }} (opens in a new tab)"
            class="inline-flex items-center justify-center rounded-full p-2.5"
            style="background-color: {{ $isDark ? '#25282b' : '#f0f1f3' }}; color: {{ $isDark ? '#ffffff' : '#111827' }};">
            @switch($platform)
                @case('linkedin')
                    <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="{{ $iconSize }}" height="{{ $iconSize }}" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-linkedin">
                                <path
                                    d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                </path>
                                <rect width="4" height="12" x="2" y="9">
                                </rect>
                                <circle cx="4" cy="4" r="2">
                                </circle>
                            </svg>
                    @break
                @case('facebook')
                    <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="{{ $iconSize }}" height="{{ $iconSize }}" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-facebook">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                </path>
                            </svg>
                    @break
                @case('instagram')
                    <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="{{ $iconSize }}" height="{{ $iconSize }}" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-instagram">
                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5">
                                </rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z">
                                </path>
                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5">
                                </line>
                            </svg>
                    @break
                @case('youtube')
                    <svg width="{{ $iconSize }}" height="{{ $iconSize }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" focusable="false"><rect x="2" y="5" width="20" height="14" rx="4"/><path d="m10 9 5 3-5 3z"/></svg>
                    @break
                @case('whatsapp')
                    <svg width="{{ $iconSize }}" height="{{ $iconSize }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M21 11.5a9 9 0 0 1-13.4 8L3 21l1.5-4.6A9 9 0 1 1 21 11.5Z"/><path d="M8 7c-2 4 3 9 7 8l1-2-3-1-1 1-2-2 1-1-1-3Z"/></svg>
                    @break
            @endswitch
        </a>
    @endforeach
</nav>
@endif
