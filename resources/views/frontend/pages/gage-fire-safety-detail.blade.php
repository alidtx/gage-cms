@extends('frontend.layouts.app')
@section('content')
    @include('frontend.components.hero', [
        'hero' => \App\Services\FrontendHero::merge([
            'variant' => 'split',
            'section_class' => 'company-hero text-white',
            'container_class' => 'container pb-20 pt-10',
            'grid_class' => 'grid items-center gap-12 lg:grid-cols-[1.2fr_1fr] lg:gap-24',
            'heading_class' => 'mt-6 text-[40px] font-bold leading-[1.12] tracking-[-1px] sm:text-[56px]',
            'heading' => [
                ['text' => 'Kitchen Hood Cleaning', 'break_class' => ''],
                ['text' => '& Annual Maintenance'],
            ],
            'description' =>
                'Keep your kitchen safe, clean and efficient. We professionally clean your entire kitchen exhaust system using industry-approved tools and techniques — boosting safety, hygiene and system performance.',
            'description_class' => 'mt-6 max-w-[620px] text-lg leading-[1.7] text-white/80',
            'logo' => ['src' => 'assets/fire-hero-logo.png', 'alt' => 'GAGE Fire Safety'],
            'image' => [
                'src' => 'assets/fire-page-0.jpg',
                'width' => 763,
                'height' => 763,
                'alt' => 'GAGE Fire Safety technicians inspecting a fire protection control panel',
                'class' => 'aspect-[.97] w-full rounded-[16px] object-cover',
            ],
            'buttons' => [
                [
                    'label' => 'Request a fire safety quote',
                    'url' => '/contact#enquiry',
                    'class' => 'button button-light !text-[#c61026]',
                    'arrow' => 'yes',
                ],
                [
                    'label' => 'Book extinguisher servicing',
                    'url' => '#servicing',
                    'class' => 'button button-outline',
                    'arrow' => 'no',
                ],
            ],
            'breadcrumb' => [
                'title' => 'GAGE Fire Safety',
                'class' => 'mb-10 flex flex-wrap gap-2 text-xs leading-6 text-white/70',
                'parents' => [['label' => 'Our Companies', 'url' => route('frontend.home') . '#companies']],
            ],
        ], $heroContent),
    ])
    <section class="section container">
        <div class="grid items-start gap-12 lg:grid-cols-2 lg:gap-24">
            <div>
                <p class="eyebrow"><span></span>WHAT’S INCLUDED</p>
                <h2>Every component, left<br>spotless.</h2>
                <div class="mt-6 space-y-5 text-base leading-[1.8] text-muted">
                    <p>A grease build-up in your hood, ducts or filters is one of the most common causes of kitchen fires.
                        Our cleaning covers the whole system — not just what you can see.</p>
                </div>
                <ul class="mt-7 space-y-3 text-sm leading-6 text-muted">
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#f8dfe3] text-xs font-extrabold text-[#c61026]"
                            aria-hidden="true">✓</span>Cleaning all nozzles in the fire suppression system</li>
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#f8dfe3] text-xs font-extrabold text-[#c61026]"
                            aria-hidden="true">✓</span>Flushing and degreasing suppression pipes</li>
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#f8dfe3] text-xs font-extrabold text-[#c61026]"
                            aria-hidden="true">✓</span>Deep cleaning of all filters</li>
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#f8dfe3] text-xs font-extrabold text-[#c61026]"
                            aria-hidden="true">✓</span>Servicing rooftop exhaust fans</li>
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#f8dfe3] text-xs font-extrabold text-[#c61026]"
                            aria-hidden="true">✓</span>Interior and exterior cleaning of exhaust ducts</li>
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#f8dfe3] text-xs font-extrabold text-[#c61026]"
                            aria-hidden="true">✓</span>Detailed cleaning of the hood, inside and out</li>
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#f8dfe3] text-xs font-extrabold text-[#c61026]"
                            aria-hidden="true">✓</span>Technically advanced cleaning machinery</li>
                </ul>
            </div>
            <figure class="relative aspect-[1.16] w-full overflow-hidden rounded-[16px]"
                aria-label="Kitchen hood before and after professional cleaning"><img src="{{ asset('assets/hood-page-1.jpg') }}" width="722" height="622"
                    alt="Kitchen hood before cleaning, with accumulated grease"
                    class="absolute inset-0 h-full w-full object-cover" loading="lazy"><img
                    src="{{ asset('assets/hood-page-2.jpg') }}" width="722" height="622"
                    alt="Kitchen hood after professional cleaning"
                    class="absolute inset-0 h-full w-full object-cover [clip-path:inset(0_0_0_50%)]" loading="lazy"><span
                    class="absolute inset-y-0 left-1/2 w-px bg-white/60" aria-hidden="true"></span></figure>
        </div>
        <div class="mt-[120px]">
            <p class="eyebrow"><span></span>WHO WE SERVE</p>
            <h2>From home kitchens to resort kitchens.</h2>
            <p class="section-intro">We clean and maintain kitchen exhaust systems of every size, meeting the highest
                standards.</p>
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#f8dfe3]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="5" y="2" width="14" height="20" rx="2" />
                            <path d="M9 6h6m-6 4h6m-6 4h2m1 4v4" />
                        </svg></span>
                    <h3 class="text-lg font-bold leading-6">Household kitchens</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Cleaner hoods and filters for safer home cooking.</p>
                </article>
                <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#f8dfe3]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m2 8 10-6 10 6H2Zm2 3v7m5-7v7m6-7v7m5-7v7M2 22h20M2 19h20" />
                        </svg></span>
                    <h3 class="text-lg font-bold leading-6">Restaurants</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Busy kitchens kept safe, hygienic and inspection-ready.
                    </p>
                </article>
                <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#f8dfe3]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M3 21V9l6 3V6l6 6h6v9ZM3 9V3h4v8m0 6h1m4 0h1m4 0h1" />
                        </svg></span>
                    <h3 class="text-lg font-bold leading-6">Hotels &amp; resorts</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Every outlet serviced on a schedule that fits your
                        operations.</p>
                </article>
                <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#f8dfe3]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="7" width="18" height="15" rx="1" />
                            <path d="M8 7V2h8v5m-8 4h1m6 0h1m-8 4h1m6 0h1m-4 7v-4" />
                        </svg></span>
                    <h3 class="text-lg font-bold leading-6">Industrial kitchens</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Large-scale exhaust systems cleaned with professional
                        machinery.</p>
                </article>
            </div>
        </div>
        <div
            class="mt-[120px] flex flex-col items-start justify-between gap-6 rounded-[16px] bg-[#c61026] p-10 text-white lg:flex-row lg:items-center">
            <div class="flex items-start gap-6"><span class="hidden sm:block"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#f8dfe3]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m12 2 8 5v9l-8 6-8-6V7Z m-4 10 3 3 5-6" />
                        </svg></span></span>
                <div>
                    <h3 class="text-2xl font-bold">Annual maintenance contracts</h3>
                    <p class="mt-3 max-w-[850px] text-sm leading-6 text-white/70">Keep your kitchen hood system running
                        safely and efficiently all year with flexible annual plans — scheduled for<br
                            class="hidden xl:block"> you, documented for your audits.</p>
                </div>
            </div><a href="./conact.html#enquiry" class="button button-light">Ask about an AMC<svg width="17"
                    height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    aria-hidden="true">
                    <path d="M5 12h14m-6-6 6 6-6 6" />
                </svg></a>
        </div>
    </section>
    <section class="section bg-[#fbeff1]">
        <div class="container">
            <p class="eyebrow"><span></span>HOW IT WORKS</p>
            <h2>Simple, scheduled, documented.</h2>
            <ol class="hood-process mt-16 grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
                <li><span
                        class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#c61026] text-sm font-bold text-white">01</span>
                    <h3 class="mt-7 text-base font-bold">Book a visit</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Tell us about your kitchen and choose a time that suits
                        your service hours.</p>
                </li>
                <li><span
                        class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#c61026] text-sm font-bold text-white">02</span>
                    <h3 class="mt-7 text-base font-bold">Inspection</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Our technicians inspect the hood, ducts, fans and
                        suppression system.</p>
                </li>
                <li><span
                        class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#c61026] text-sm font-bold text-white">03</span>
                    <h3 class="mt-7 text-base font-bold">Deep clean</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Every component is cleaned and degreased with professional
                        machinery.</p>
                </li>
                <li><span
                        class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#c61026] text-sm font-bold text-white">04</span>
                    <h3 class="mt-7 text-base font-bold">Report &amp; schedule</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">You receive a service record and a recommended cleaning
                        schedule.</p>
                </li>
            </ol>
        </div>
    </section>
    <section class="section container">
        <p class="eyebrow"><span></span>WHY GAGE FIRE SAFETY</p>
        <h2>Fire safety specialists, not just cleaners.</h2>
        <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <article><span
                    class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#f8dfe3]"><svg
                        width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m2 8 10-5 10 5-10 5-10-5Zm4 3v6c4 4 8 4 12 0v-6m4-3v9" />
                    </svg></span>
                <h3 class="text-lg font-bold leading-6">Certified fire safety experts</h3>
                <p class="mt-3 text-sm leading-6 text-muted">Your hood is cleaned by fire safety professionals who
                    understand the suppression system inside it.</p>
            </article>
            <article><span
                    class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#f8dfe3]"><svg
                        width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m12 2 8 5v9l-8 6-8-6V7Z m-4 10 3 3 5-6" />
                    </svg></span>
                <h3 class="text-lg font-bold leading-6">Hassle-free annual scheduling</h3>
                <p class="mt-3 text-sm leading-6 text-muted">We plan and remind you of every visit, so nothing is missed.
                </p>
            </article>
            <article><span
                    class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#f8dfe3]"><svg
                        width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 6v6l4 2" />
                    </svg></span>
                <h3 class="text-lg font-bold leading-6">Full regulatory compliance</h3>
                <p class="mt-3 text-sm leading-6 text-muted">Service records ready for audits and inspections.</p>
            </article>
            <article><span
                    class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#f8dfe3]"><svg
                        width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="8" r="5" />
                        <path d="m8 12-1 10 5-3 5 3-1-10" />
                    </svg></span>
                <h3 class="text-lg font-bold leading-6">Trusted by industry, offices &amp; hospitals</h3>
                <p class="mt-3 text-sm leading-6 text-muted">The same team trusted by resorts, banks and public buildings.
                </p>
            </article>
        </div>
        <div class="mt-[120px]">
            <p class="eyebrow"><span></span>FAQ</p>
            <h2>Questions we’re often asked.</h2>
            <div class="physical-faq mt-10 border-t border-[#c9cdd3]">
                <details class="border-b border-[#c9cdd3] py-6" open>
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                        How often should a kitchen hood be cleaned?<span
                            class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                            aria-hidden="true"></span></summary>
                    <p class="mt-5 pr-10 text-sm leading-7 text-muted">It depends on how much and what you cook. Busy
                        commercial kitchens need cleaning more often than household kitchens — we’ll recommend a schedule
                        after inspecting your system.</p>
                </details>
                <details class="border-b border-[#c9cdd3] py-6">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                        Do you clean the fire suppression system too?<span
                            class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                            aria-hidden="true"></span></summary>
                    <p class="mt-5 pr-10 text-sm leading-7 text-muted">Yes. Every service includes cleaning all nozzles in
                        the fire suppression system and flushing and degreasing the suppression pipes.</p>
                </details>
                <details class="border-b border-[#c9cdd3] py-6">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                        Will cleaning disrupt our kitchen service?<span
                            class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                            aria-hidden="true"></span></summary>
                    <p class="mt-5 pr-10 text-sm leading-7 text-muted">We schedule each visit around your service hours to
                        keep disruption to a minimum.</p>
                </details>
                <details class="border-b border-[#c9cdd3] py-6">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                        Can you service kitchens at resorts outside Malé?<span
                            class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                            aria-hidden="true"></span></summary>
                    <p class="mt-5 pr-10 text-sm leading-7 text-muted">Yes. Our team services kitchens at resorts and
                        properties across the Maldives.</p>
                </details>
                <details class="border-b border-[#c9cdd3] py-6">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                        What records do we receive after a service?<span
                            class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                            aria-hidden="true"></span></summary>
                    <p class="mt-5 pr-10 text-sm leading-7 text-muted">You receive a service record for your files and
                        audits, with a recommended date for your next cleaning.</p>
                </details>
            </div>
        </div>
        <div class="mt-[120px]">
            <p class="eyebrow"><span></span>RELATED SERVICES</p>
            <h2>You may also need.</h2>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#f8dfe3]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m2 8 10-5 10 5-10 5-10-5Zm4 3v6c4 4 8 4 12 0v-6m4-3v9" />
                        </svg></span>
                    <h3 class="text-xl font-bold">Automatic Fire Suppression Systems</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Including kitchen hood wet chemical suppression with delay
                        timing.</p><a href="./GAGE-Fire-Safety.html#services"
                        class="mt-auto inline-flex items-center gap-2 pt-6 text-sm font-bold">View service<svg
                            width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a>
                </article>
                <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#f8dfe3]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m12 2 8 5v9l-8 6-8-6V7Z m-4 10 3 3 5-6" />
                        </svg></span>
                    <h3 class="text-xl font-bold">LPG Gas System Maintenance</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Inspection, testing and rectification for safe, compliant
                        LPG systems.</p><a href="./GAGE-Fire-Safety.html#services"
                        class="mt-auto inline-flex items-center gap-2 pt-6 text-sm font-bold">View service<svg
                            width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a>
                </article>
                <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#f8dfe3]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 6v6l4 2" />
                        </svg></span>
                    <h3 class="text-xl font-bold">Monthly Maintenance &amp; After-sales</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Scheduled inspections that keep every system compliant.
                    </p><a href="./GAGE-Fire-Safety.html#services"
                        class="mt-auto inline-flex items-center gap-2 pt-6 text-sm font-bold">View service<svg
                            width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a>
                </article>
            </div>
        </div>
        <div
            class="mt-[120px] flex flex-col justify-between gap-9 rounded-[24px] bg-[#c61026] px-9 py-16 text-white lg:flex-row lg:items-center lg:px-16">
            <div>
                <h2 class="!mt-0">Book your kitchen hood<br class="hidden lg:block"> cleaning.</h2>
                <p class="mt-5 max-w-[740px] text-base leading-7 text-white/70">Tell us about your kitchen. We’ll confirm a
                    time that suits your service hours.</p>
            </div>
            <div class="flex flex-col gap-3 lg:min-w-[320px]"><a href="./conact.html#enquiry"
                    class="button button-light">Book a hood cleaning<svg width="17" height="17"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a><a href="tel:+9603304055" class="button button-outline">Call +960 330 4055<svg
                        width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a></div>
        </div>
    </section>
@endsection
