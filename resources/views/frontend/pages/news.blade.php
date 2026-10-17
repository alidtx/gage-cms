@extends('frontend.layouts.app')
@section('content')
@include('frontend.components.hero')
    <section class="bg-black text-white">
        <div class="container pb-[140px] pt-10">
            <nav aria-label="Breadcrumb" class="mb-10 flex gap-3 text-xs text-[#b9bec4]"><a href="./index.html">Home</a><span
                    aria-hidden="true">›</span><span class="text-white">News</span></nav>
            <p class="eyebrow"><span></span>NEWS</p>
            <h1 class="mt-7 text-[42px] font-bold leading-[1.12] tracking-[-1px] sm:text-[56px]">News & updates.</h1>
            <p class="mt-6 text-lg leading-[1.7] text-[#b9bec4]">Announcements, events and stories from across the GAGE
                companies.</p>
        </div>
    </section>
    <section id="news-list" class="news-listing container pb-[120px] pt-16">
        <fieldset class="mb-14 flex flex-wrap gap-3">
            <legend class="sr-only">Filter news by GAGE company</legend>
            <div><input class="news-filter sr-only" type="radio" name="news-category" id="filter-all" value="all"
                    checked><label for="filter-all" class="news-filter-label">All</label></div>
            <div><input class="news-filter sr-only" type="radio" name="news-category" id="filter-group"
                    value="group"><label for="filter-group" class="news-filter-label">GAGE Group</label></div>
            <div><input class="news-filter sr-only" type="radio" name="news-category" id="filter-security"
                    value="security"><label for="filter-security" class="news-filter-label"><span
                        class="h-2 w-2 rounded-full" style="background:#000"></span>GAGE Security</label></div>
            <div><input class="news-filter sr-only" type="radio" name="news-category" id="filter-fire"
                    value="fire"><label for="filter-fire" class="news-filter-label"><span class="h-2 w-2 rounded-full"
                        style="background:#c61026"></span>GAGE Fire Safety</label></div>
            <div><input class="news-filter sr-only" type="radio" name="news-category" id="filter-training"
                    value="training"><label for="filter-training" class="news-filter-label"><span
                        class="h-2 w-2 rounded-full" style="background:#2430ce"></span>GAGE Training Institute</label></div>
            <div><input class="news-filter sr-only" type="radio" name="news-category" id="filter-technology"
                    value="technology"><label for="filter-technology" class="news-filter-label"><span
                        class="h-2 w-2 rounded-full" style="background:#197379"></span>GAGE Technology</label></div>
        </fieldset>
        <article
            class="news-item featured-news grid items-center gap-10 border-b border-[#dfe2e7] pb-16 lg:grid-cols-[1.5fr_1fr] lg:gap-12"
            data-category="group"><img src="./public/assets/news-0.jpg"
                alt="GAGE celebrates sixteen years with a geometric turquoise 16"
                class="aspect-[1.6] w-full rounded-[14px] object-cover" fetchpriority="high">
            <div>
                <p class="text-xs font-extrabold tracking-wide">● FEATURED · GAGE GROUP · 21 JULY 2026</p>
                <h2 class="mt-6 !text-[36px]">GAGE turns 16 and<br class="hidden lg:block"> introduces GAGE<br
                        class="hidden lg:block"> Technology</h2>
                <p class="mt-6 text-base leading-7 text-muted">Sixteen years after our founding, a fifth company joins the
                    group — bringing IT, networking and integrated security systems under the GAGE name.</p><a
                    href="./News-Article.html"
                    class="mt-8 inline-flex items-center gap-3 rounded-md bg-black px-6 py-4 text-sm font-bold text-white">Read
                    article<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a>
            </div>
        </article>
        <div class="news-grid mt-16 grid gap-x-6 gap-y-16 md:grid-cols-3">
            <article class="news-item flex flex-col" data-category="group"><img src="./public/assets/news-1.jpg"
                    alt="Smart intrusion and fire safety, live at Living Expo 2026"
                    class="aspect-[1.7] w-full rounded-[14px] object-cover" loading="lazy">
                <p class="mt-6 text-[11px] font-extrabold tracking-wide" style="color:#000">● GAGE GROUP · [DD MONTH 2026]
                </p>
                <h2 class="!mt-4 !text-xl !leading-[1.4] !tracking-normal">Smart intrusion and fire safety, live at Living
                    Expo 2026</h2>
                <p class="mt-3 flex-1 text-sm leading-6 text-muted">Visitors explored a full home layout of connected
                    intrusion and fire & life safety devices at the GAGE booth.</p><button type="button"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold" style="color:#000">Read
                    more<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></button>
            </article>
            <article class="news-item flex flex-col" data-category="group"><img src="./public/assets/news-2.png"
                    alt="GAGE named a GOLD100 awardee for the third year running"
                    class="aspect-[1.7] w-full rounded-[14px] object-cover" loading="lazy">
                <p class="mt-6 text-[11px] font-extrabold tracking-wide" style="color:#000">● GAGE GROUP · [DD MONTH YYYY]
                </p>
                <h2 class="!mt-4 !text-xl !leading-[1.4] !tracking-normal">GAGE named a GOLD100 awardee for the third year
                    running</h2>
                <p class="mt-3 flex-1 text-sm leading-6 text-muted">The Maldives’ most prestigious business award
                    recognises GAGE for a third consecutive year.</p><button type="button"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold" style="color:#000">Read
                    more<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></button>
            </article>
            <article class="news-item flex flex-col" data-category="group"><img src="./public/assets/news-3.jpg"
                    alt="GAGE appointed Safety & Security Partner for TechEng 2025"
                    class="aspect-[1.7] w-full rounded-[14px] object-cover" loading="lazy">
                <p class="mt-6 text-[11px] font-extrabold tracking-wide" style="color:#000">● GAGE GROUP · [DD MONTH 2025]
                </p>
                <h2 class="!mt-4 !text-xl !leading-[1.4] !tracking-normal">GAGE appointed Safety & Security Partner for
                    TechEng 2025</h2>
                <p class="mt-3 flex-1 text-sm leading-6 text-muted">GAGE supports the Maldives’ first dedicated B2B
                    engineering and technology exhibition for hospitality.</p><button type="button"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold" style="color:#000">Read
                    more<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></button>
            </article>
            <article class="news-item flex flex-col" data-category="group"><img src="./public/assets/news-4.jpg"
                    alt="Fifteen years of GAGE — and a new look for our four companies"
                    class="aspect-[1.7] w-full rounded-[14px] object-cover" loading="lazy">
                <p class="mt-6 text-[11px] font-extrabold tracking-wide" style="color:#000">● GAGE GROUP · 21 JULY 2025
                </p>
                <h2 class="!mt-4 !text-xl !leading-[1.4] !tracking-normal">Fifteen years of GAGE — and a new look for our
                    four companies</h2>
                <p class="mt-3 flex-1 text-sm leading-6 text-muted">Our anniversary marked the launch of refreshed
                    identities for GAGE Security, Fire Safety, Training Institute and Store.</p><button type="button"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold" style="color:#000">Read
                    more<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></button>
            </article>
            <article class="news-item flex flex-col" data-category="fire"><img src="./public/assets/news-5.jpg"
                    alt="Thulusdoo Training Facility coming soon" class="aspect-[1.7] w-full rounded-[14px] object-cover"
                    loading="lazy">
                <p class="mt-6 text-[11px] font-extrabold tracking-wide" style="color:#c61026">● GAGE FIRE SAFETY · [DD
                    MONTH YYYY]</p>
                <h2 class="!mt-4 !text-xl !leading-[1.4] !tracking-normal">Thulusdoo Training Facility coming soon</h2>
                <p class="mt-3 flex-1 text-sm leading-6 text-muted">The Maldives’ first internationally approved fire
                    training center is on its way.</p><button type="button"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold" style="color:#c61026">Read
                    more<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></button>
            </article>
            <article class="news-item flex flex-col" data-category="training"><img src="./public/assets/news-6.jpg"
                    alt="Applications open for our Security Officer certificate"
                    class="aspect-[1.7] w-full rounded-[14px] object-cover" loading="lazy">
                <p class="mt-6 text-[11px] font-extrabold tracking-wide" style="color:#2430ce">● GAGE TRAINING INSTITUTE ·
                    [DD MONTH 2025]</p>
                <h2 class="!mt-4 !text-xl !leading-[1.4] !tracking-normal">Applications open for our Security Officer
                    certificate</h2>
                <p class="mt-3 flex-1 text-sm leading-6 text-muted">Join the next intake of our MQA-approved Certificate I
                    in Security Officer Training.</p><button type="button"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold" style="color:#2430ce">Read
                    more<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></button>
            </article>
        </div>
        <p class="news-empty rounded-xl border border-[#dfe2e7] p-10 text-center text-muted" role="status">No news in
            this category yet. Explore all news for the latest updates.</p>
        <nav aria-label="News pagination" class="news-pagination mt-20 flex justify-center gap-2"><a href="#news-list"
                aria-label="Previous page" class="pagination-link">‹</a><a href="#news-list" aria-current="page"
                class="pagination-link">1</a><a href="#news-list" class="pagination-link">2</a><a href="#news-list"
                class="pagination-link">3</a><a href="#news-list" aria-label="Next page" class="pagination-link">›</a>
        </nav>
    </section>
    <section id="contact" class="container pb-[120px]">
        <div
            class="flex flex-col justify-between gap-9 rounded-[24px] bg-black px-9 py-16 text-white lg:flex-row lg:items-center lg:px-16">
            <div>
                <h2 class="!mt-0">Get Protected Now.</h2>
                <p class="mt-4 max-w-[740px] text-base leading-7 text-[#b9bec4]">Tell us what you need to protect.
                    Our team will recommend the right mix of security,<br class="hidden xl:block"> fire safety,
                    training and technology — and give you a clear proposal.</p>
            </div>
            <div class="flex min-w-[290px] flex-col gap-3">
                <a href="./conact.html" class="button button-light">Request a
                    quote<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-right">
                        <path d="M5 12h14">
                        </path>
                        <path d="m12 5 7 7-7 7">
                        </path>
                    </svg>
                </a>
                <a class="button button-outline justify-between" href="tel:+9603304055">Call +960 330 4055<svg
                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-phone">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
@endsection
