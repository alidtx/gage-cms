@extends('frontend.layouts.app')
@section('content')
    @include('frontend.components.hero', [
        'hero' => \App\Services\FrontendHero::merge(
            [
                'variant' => 'split',
                'section_class' => 'company-hero text-white',
                'container_class' => 'container pb-20 pt-10',
                'grid_class' => 'grid items-center gap-12 lg:grid-cols-[1.2fr_1fr] lg:gap-24',
                'heading_class' => 'mt-6 text-[40px] font-bold leading-[1.12] tracking-[-1px] sm:text-[56px]',
                'heading' => [
                    ['text' => 'CCTV & Video,', 'break_class' => ''],
                    ['text' => 'Surveillance,', 'break_class' => ''],
                ],
                'description' =>
                    'High-definition surveillance with recording, remote viewing and smart detection — designed, installed and supported by GAGE Technology for resorts, businesses and institutions.',
                'description_class' => 'mt-6 max-w-[620px] text-lg leading-[1.7] text-white/80',
                'logo' => ['src' => 'assets/technology-hero-logo.png', 'alt' => 'GAGE Technology'],
                'image' => [
                    'src' => 'assets/cctv-page-0.jpg',
                    'width' => 811,
                    'height' => 1086,
                    'alt' => 'GAGE engineer maintaining a network server rack',
                    'class' => 'aspect-[.86] w-full rounded-[16px] object-cover',
                ],
                'buttons' => [
                    [
                        'label' => 'Plan your system',
                        'url' => '/contact#enquiry',
                        'class' => 'button button-light !text-[#197379]',
                        'arrow' => 'yes',
                    ],
                    [
                        'label' => 'View services',
                        'url' => '#services',
                        'class' => 'button button-outline',
                        'arrow' => 'yes',
                    ],
                ],
                'breadcrumb' => [
                    'title' => 'GAGE Technology',
                    'class' => 'mb-10 flex flex-wrap gap-2 text-xs leading-6 text-white/70',
                    'parents' => [['label' => 'Our Companies', 'url' => route('frontend.home') . '#companies']],
                ],
            ],
            $heroContent),
    ])
 
    <section class="section container">
        <div class="grid items-start gap-12 lg:grid-cols-2 lg:gap-24">
            <div>
                <p class="eyebrow"><span></span>WHAT’S INCLUDED</p>
                <h2>A system designed<br>around your site.</h2>
                <div class="mt-6 space-y-5 text-base leading-[1.8] text-muted">
                    <p>Good surveillance starts with a good design. We survey your property, agree what each camera needs to
                        see, and build a system that records reliably and is easy for your team to use.</p>
                    <p>Then we stay with you — with support and maintenance that keep every camera online.</p>
                </div>
                <ul class="mt-7 space-y-3 text-sm leading-6 text-muted">
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e0edef] text-xs font-extrabold text-[#197379]"
                            aria-hidden="true">✓</span>Site survey and camera coverage design</li>
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e0edef] text-xs font-extrabold text-[#197379]"
                            aria-hidden="true">✓</span>Indoor and outdoor cameras selected for each location</li>
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e0edef] text-xs font-extrabold text-[#197379]"
                            aria-hidden="true">✓</span>Network video recorders and storage sized to your needs</li>
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e0edef] text-xs font-extrabold text-[#197379]"
                            aria-hidden="true">✓</span>Secure remote viewing on mobile and desktop</li>
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e0edef] text-xs font-extrabold text-[#197379]"
                            aria-hidden="true">✓</span>Smart detection and alerts</li>
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e0edef] text-xs font-extrabold text-[#197379]"
                            aria-hidden="true">✓</span>Integration with access control and intrusion alarms</li>
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e0edef] text-xs font-extrabold text-[#197379]"
                            aria-hidden="true">✓</span>Structured cabling, installation and commissioning</li>
                    <li class="flex gap-3"><span
                            class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e0edef] text-xs font-extrabold text-[#197379]"
                            aria-hidden="true">✓</span>Handover, user training and ongoing support</li>
                </ul>
            </div><img src="{{ asset('assets/cctv-page-1.jpg') }}"
                alt="GAGE engineers reviewing surveillance footage in a control room"
                class="aspect-[1.08] w-full rounded-[16px] object-cover" loading="lazy">
        </div>
        <div class="mt-[120px]">
            <p class="eyebrow"><span></span>WHO WE SERVE</p>
            <h2>Built for the way the Maldives works.</h2>
            <p class="section-intro">Coverage for villas, jetties, offices and back-of-house — wherever you need eyes on
                your property.</p>
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="5" y="2" width="14" height="20" rx="2" />
                            <path d="M9 6h6m-6 4h6m-6 4h2m1 4v4" />
                        </svg></span>
                    <h3 class="text-lg font-bold leading-6">Resorts</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Arrival jetties, walkways, villas and back-of-house areas —
                        covered discreetly.</p>
                </article>
                <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m2 8 10-6 10 6H2Zm2 3v7m5-7v7m6-7v7m5-7v7M2 22h20M2 19h20" />
                        </svg></span>
                    <h3 class="text-lg font-bold leading-6">Businesses</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Offices, retail and warehouses that need clear footage and
                        fast search.</p>
                </article>
                <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M3 21V9l6 3V6l6 6h6v9ZM3 9V3h4v8m0 6h1m4 0h1m4 0h1" />
                        </svg></span>
                    <h3 class="text-lg font-bold leading-6">Institutions</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Banks, schools and healthcare facilities with demanding
                        security needs.</p>
                </article>
                <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="7" width="18" height="15" rx="1" />
                            <path d="M8 7V2h8v5m-8 4h1m6 0h1m-8 4h1m6 0h1m-4 7v-4" />
                        </svg></span>
                    <h3 class="text-lg font-bold leading-6">Residences</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Homes and residential buildings protected with simple,
                        reliable systems.</p>
                </article>
            </div>
        </div>
        <div
            class="mt-[120px] flex flex-col items-start justify-between gap-6 rounded-[16px] bg-[#197379] p-10 text-white lg:flex-row lg:items-center">
            <div class="flex items-start gap-6"><span class="hidden sm:block"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m12 2 8 5v9l-8 6-8-6V7Z m-4 10 3 3 5-6" />
                        </svg></span></span>
                <div>
                    <h3 class="text-2xl font-bold">Keep every camera recording.</h3>
                    <p class="mt-3 max-w-[850px] text-sm leading-6 text-white/70">Preventive maintenance and annual
                        maintenance contracts (AMC) catch problems early, so your system is<br class="hidden xl:block">
                        ready when you need the footage.</p>
                </div>
            </div><a href="./conact.html#enquiry" class="button button-light">Ask about an AMC<svg width="17"
                    height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    aria-hidden="true">
                    <path d="M5 12h14m-6-6 6 6-6 6" />
                </svg></a>
        </div>
    </section>
    <section class="section bg-[#eff5f6]">
        <div class="container">
            <p class="eyebrow"><span></span>HOW IT WORKS</p>
            <h2>From survey to support.</h2>
            <ol class="mt-16 grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
                <li><span
                        class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#197379] text-sm font-bold text-white">01</span>
                    <h3 class="mt-7 text-base font-bold">Survey &amp; design</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">We assess your site and agree coverage, camera positions
                        and recording needs.</p>
                </li>
                <li><span
                        class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#197379] text-sm font-bold text-white">02</span>
                    <h3 class="mt-7 text-base font-bold">Supply &amp; install</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Certified engineers install cameras, cabling and recorders
                        with minimal disruption.</p>
                </li>
                <li><span
                        class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#197379] text-sm font-bold text-white">03</span>
                    <h3 class="mt-7 text-base font-bold">Commission &amp; train</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Every camera is tested and your team is trained to view,
                        search and export footage.</p>
                </li>
                <li><span
                        class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#197379] text-sm font-bold text-white">04</span>
                    <h3 class="mt-7 text-base font-bold">Support &amp; AMC</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Managed support and preventive maintenance keep the system
                        running.</p>
                </li>
            </ol>
        </div>
    </section>
    <section class="section container">
        <p class="eyebrow"><span></span>WHY GAGE TECHNOLOGY</p>
        <h2>One partner from design to support.</h2>
        <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            <article><span
                    class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef]"><svg
                        width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m2 8 10-5 10 5-10 5-10-5Zm4 3v6c4 4 8 4 12 0v-6m4-3v9" />
                    </svg></span>
                <h3 class="text-lg font-bold leading-6">Integrated by design</h3>
                <p class="mt-3 text-sm leading-6 text-muted">CCTV that works with your access control, alarms and network —
                    not a standalone box.</p>
            </article>
            <article><span
                    class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef]"><svg
                        width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m12 2 8 5v9l-8 6-8-6V7Z m-4 10 3 3 5-6" />
                    </svg></span>
                <h3 class="text-lg font-bold leading-6">End-to-end delivery</h3>
                <p class="mt-3 text-sm leading-6 text-muted">Survey, design, installation, commissioning and handover from
                    one team.</p>
            </article>
            <article><span
                    class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef]"><svg
                        width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="9" />
                        <path d="M12 6v6l4 2" />
                    </svg></span>
                <h3 class="text-lg font-bold leading-6">Managed support</h3>
                <p class="mt-3 text-sm leading-6 text-muted">A responsive technical team when you need help.</p>
            </article>
            <article><span
                    class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef]"><svg
                        width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="8" r="5" />
                        <path d="m8 12-1 10 5-3 5 3-1-10" />
                    </svg></span>
                <h3 class="text-lg font-bold leading-6">Backed by GAGE</h3>
                <p class="mt-3 text-sm leading-6 text-muted">Part of the group trusted by the Maldives’ leading resorts,
                    banks and institutions.</p>
            </article>
        </div>
        <div class="mt-[120px]">
            <p class="eyebrow"><span></span>FAQ</p>
            <h2>Questions we’re often asked.</h2>
            <div class="physical-faq mt-10 border-t border-[#c9cdd3]">
                <details class="border-b border-[#c9cdd3] py-6" open>
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                        Can I view my cameras remotely?<span
                            class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                            aria-hidden="true"></span></summary>
                    <p class="mt-5 pr-10 text-sm leading-7 text-muted">Yes. We set up secure remote viewing so authorised
                        people can watch live and recorded footage on mobile and desktop.</p>
                </details>
                <details class="border-b border-[#c9cdd3] py-6">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                        How long is footage stored?<span
                            class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                            aria-hidden="true"></span></summary>
                    <p class="mt-5 pr-10 text-sm leading-7 text-muted">Storage is sized during design. We’ll recommend a
                        recording period based on your camera count, resolution and needs.</p>
                </details>
                <details class="border-b border-[#c9cdd3] py-6">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                        Can you upgrade or take over an existing CCTV system?<span
                            class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                            aria-hidden="true"></span></summary>
                    <p class="mt-5 pr-10 text-sm leading-7 text-muted">Contact our engineers to confirm whether your
                        existing system can be upgraded or brought under support.</p>
                </details>
                <details class="border-b border-[#c9cdd3] py-6">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                        Can CCTV work with our access control and alarms?<span
                            class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                            aria-hidden="true"></span></summary>
                    <p class="mt-5 pr-10 text-sm leading-7 text-muted">Yes. As part of our ELV &amp; integrated technology
                        service, we can bring CCTV, access control and intrusion alarms into one manageable system.</p>
                </details>
                <details class="border-b border-[#c9cdd3] py-6">
                    <summary class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                        Do you offer maintenance contracts?<span
                            class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                            aria-hidden="true"></span></summary>
                    <p class="mt-5 pr-10 text-sm leading-7 text-muted">Yes. Preventive maintenance and annual maintenance
                        contracts (AMC) keep your system running and extend its life.</p>
                </details>
            </div>
        </div>
        <div class="mt-[120px]">
            <p class="eyebrow"><span></span>RELATED SERVICES</p>
            <h2>You may also need.</h2>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m2 8 10-5 10 5-10 5-10-5Zm4 3v6c4 4 8 4 12 0v-6m4-3v9" />
                        </svg></span>
                    <h3 class="text-xl font-bold">Access Control &amp; Biometric Systems</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Control who goes where with cards, PINs and biometrics.
                    </p><a href="./GAGE-Technology.html#services"
                        class="mt-auto inline-flex items-center gap-2 pt-6 text-sm font-bold">View service<svg
                            width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a>
                </article>
                <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m12 2 8 5v9l-8 6-8-6V7Z m-4 10 3 3 5-6" />
                        </svg></span>
                    <h3 class="text-xl font-bold">Intrusion &amp; Alarm Systems</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Wireless and wired intrusion detection with instant
                        alerts.</p><a href="./GAGE-Technology.html#services"
                        class="mt-auto inline-flex items-center gap-2 pt-6 text-sm font-bold">View service<svg
                            width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a>
                </article>
                <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 6v6l4 2" />
                        </svg></span>
                    <h3 class="text-xl font-bold">Preventive Maintenance &amp; AMC</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Scheduled maintenance that prevents downtime and extends
                        system life.</p><a href="./GAGE-Technology.html#services"
                        class="mt-auto inline-flex items-center gap-2 pt-6 text-sm font-bold">View service<svg
                            width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a>
                </article>
            </div>
        </div>
        <div
            class="mt-[120px] flex flex-col justify-between gap-9 rounded-[24px] bg-[#197379] px-9 py-16 text-white lg:flex-row lg:items-center lg:px-16">
            <div>
                <h2 class="!mt-0">Plan your CCTV system.</h2>
                <p class="mt-5 max-w-[740px] text-base leading-7 text-white/70">Tell us about your property and what you
                    need to see. Our engineers will<br class="hidden xl:block"> recommend the right system.</p>
            </div>
            <div class="flex flex-col gap-3 lg:min-w-[320px]"><a href="./conact.html#enquiry"
                    class="button button-light">Request a site survey<svg width="17" height="17"
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
