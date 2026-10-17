<div class="bg-black text-white">
        <div class="container flex min-h-10 items-center justify-between gap-4 text-[12px] font-semibold">
            <div class="flex items-center gap-6">
                <a class="flex items-center gap-2" href="tel:+9603304055">
                    <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-headphones">
                        <path
                            d="M3 14h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7a9 9 0 0 1 18 0v7a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3">
                        </path>
                    </svg>
                    <span class="hidden text-gray-400 sm:inline font-normal">Round-the-clock support</span> +960 330
                    4055</a>
                <a href="mailto:info@gage.com.mv" class="hidden items-center gap-2 sm:flex">
                    <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-mail">
                        <rect width="20" height="16" x="2" y="4" rx="2">
                        </rect>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7">
                        </path>
                    </svg>info@gage.com.mv</a>
            </div>
            <a href="https://shop.gage.com.mv" target="_blank" rel="noreferrer" class="flex items-center gap-1">
                <span class="hidden md:inline">Shop safety &amp; security products at </span>GAGE Store<svg
                    xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-up-right">
                    <path d="M7 7h10v10">
                    </path>
                    <path d="M7 17 17 7">
                    </path>
                </svg>
            </a>
        </div>
    </div>
    <header class="site-header sticky top-0 z-40 bg-white">
        <div class="container flex h-[100px] items-center justify-between gap-8">
            <a href="{{ route('frontend.home') }}" aria-label="GAGE home">
                <img width="270" height="62" decoding="async" class="w-[270px] max-w-[42vw]" alt="GAGE — Experts in Safety &amp; Security"
                    src="{{ asset('assets/logo.png') }}">
            </a>
            @include('frontend.partials.navbar')
        </div>
    </header>
