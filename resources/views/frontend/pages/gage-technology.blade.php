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
                    ['text' => 'Connected,', 'break_class' => ''],
                    ['text' => 'protected,', 'break_class' => ''],
                    ['text' => 'operational.'],
                ],
                'description' =>
                    'GAGE Technology delivers integrated IT, networking, security and communications solutions that keep businesses, resorts and institutions connected, protected and operational — from system design to ongoing support.',
                'description_class' => 'mt-6 max-w-[620px] text-lg leading-[1.7] text-white/80',
                'logo' => ['src' => 'assets/technology-hero-logo.png', 'alt' => 'GAGE Technology'],
                'image' => [
                    'src' => 'assets/technology-page-0.jpg',
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
        <p class="eyebrow text-[#197379]"><span></span>SEE HOW IT CONNECTS</p>
        <h2>One integrated system, every zone<br class="hidden lg:block"> covered.</h2>
        <p class="section-intro">Explore a typical resort property. Select a point to see the technology behind it.
        </p>
        <div class="technology-explorer mt-12" role="group" aria-label="Explore resort technology"><input
                class="tech-radio sr-only" type="radio" name="technology-zone" id="tech-zone-1"
                aria-label="Network &amp; Wi-Fi"><input class="tech-radio sr-only" type="radio" name="technology-zone"
                id="tech-zone-2" checked aria-label="Access control"><input class="tech-radio sr-only" type="radio"
                name="technology-zone" id="tech-zone-3" aria-label="CCTV &amp; surveillance"><input
                class="tech-radio sr-only" type="radio" name="technology-zone" id="tech-zone-4"
                aria-label="Intrusion &amp; alarm"><input class="tech-radio sr-only" type="radio" name="technology-zone"
                id="tech-zone-5" aria-label="Communications &amp; radio"><input class="tech-radio sr-only" type="radio"
                name="technology-zone" id="tech-zone-6" aria-label="Server &amp; backup room">
            <div class="tech-map relative overflow-hidden rounded-[16px]"><img src="./public/assets/technology-page-1.jpg"
                    alt="Cutaway of resort villas showing network, security and communications equipment"
                    class="h-full w-full object-cover"><label for="tech-zone-1" class="tech-hotspot tech-point-1"
                    style="left:74%;top:46%" title="Network &amp; Wi-Fi">01</label><label for="tech-zone-2"
                    class="tech-hotspot tech-point-2" style="left:46%;top:32%" title="Access control">02</label><label
                    for="tech-zone-3" class="tech-hotspot tech-point-3" style="left:24%;top:85%"
                    title="CCTV &amp; surveillance">03</label><label for="tech-zone-4" class="tech-hotspot tech-point-4"
                    style="left:35%;top:43%" title="Intrusion &amp; alarm">04</label><label for="tech-zone-5"
                    class="tech-hotspot tech-point-5" style="left:48%;top:92%"
                    title="Communications &amp; radio">05</label><label for="tech-zone-6" class="tech-hotspot tech-point-6"
                    style="left:93%;top:82%" title="Server &amp; backup room">06</label></div>
            <div class="tech-details rounded-[16px] border border-[#dfe2e7] p-7 sm:p-8">
                <div class="tech-panel tech-panel-1">
                    <p class="text-xs font-bold tracking-wider text-[#197379]">01 — SELECTED</p>
                    <div class="mt-6"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef] text-[#197379]"><svg
                                width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="9" y="2" width="6" height="6" rx="1" />
                                <rect x="2" y="16" width="6" height="6" rx="1" />
                                <rect x="16" y="16" width="6" height="6" rx="1" />
                                <path d="M12 8v5H5v3m7-3h7v3" />
                            </svg></span></div>
                    <h3 class="text-2xl font-bold leading-tight">Network &amp; Connectivity Solutions</h3>
                    <p class="mt-4 min-h-[115px] text-sm leading-6 text-muted">Wired and wireless networks designed
                        for coverage, speed and reliability across your property.</p><a href="#services"
                        class="mt-7 inline-flex items-center gap-2 text-sm font-bold text-[#197379]">View
                        service<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a>
                </div>
                <div class="tech-panel tech-panel-2">
                    <p class="text-xs font-bold tracking-wider text-[#197379]">02 — SELECTED</p>
                    <div class="mt-6"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef] text-[#197379]"><svg
                                width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M8 13v-3a4 4 0 0 1 8 0v4m-11 0v-4a7 7 0 0 1 14 0v5M8 16v2m4-7v9m4-3v3" />
                            </svg></span></div>
                    <h3 class="text-2xl font-bold leading-tight">Access Control &amp; Biometric Systems</h3>
                    <p class="mt-4 min-h-[115px] text-sm leading-6 text-muted">Cards, PINs and biometric readers
                        control who enters villas, staff areas and back-of-house — with every entry logged.</p><a
                        href="#services"
                        class="mt-7 inline-flex items-center gap-2 text-sm font-bold text-[#197379]">View
                        service<svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a>
                </div>
                <div class="tech-panel tech-panel-3">
                    <p class="text-xs font-bold tracking-wider text-[#197379]">03 — SELECTED</p>
                    <div class="mt-6"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef] text-[#197379]"><svg
                                width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m3 6 13 3-2 7L2 12Z M15 10h5v5h-6M7 15v6m-4 0h8" />
                            </svg></span></div>
                    <h3 class="text-2xl font-bold leading-tight">CCTV &amp; Video Surveillance</h3>
                    <p class="mt-4 min-h-[115px] text-sm leading-6 text-muted">High-definition surveillance with
                        recording, remote viewing and smart detection.</p><a href="#services"
                        class="mt-7 inline-flex items-center gap-2 text-sm font-bold text-[#197379]">View
                        service<svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a>
                </div>
                <div class="tech-panel tech-panel-4">
                    <p class="text-xs font-bold tracking-wider text-[#197379]">04 — SELECTED</p>
                    <div class="mt-6"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef] text-[#197379]"><svg
                                width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M6 8h12v11H6ZM9 8V5h6v3M3 11H1m22 0h-2M3 17H1m22 0h-2M9 22v-3m6 3v-3M12 1v2" />
                            </svg></span></div>
                    <h3 class="text-2xl font-bold leading-tight">Intrusion &amp; Alarm Systems</h3>
                    <p class="mt-4 min-h-[115px] text-sm leading-6 text-muted">Wireless and wired intrusion
                        detection with instant alerts.</p><a href="#services"
                        class="mt-7 inline-flex items-center gap-2 text-sm font-bold text-[#197379]">View
                        service<svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a>
                </div>
                <div class="tech-panel tech-panel-5">
                    <p class="text-xs font-bold tracking-wider text-[#197379]">05 — SELECTED</p>
                    <div class="mt-6"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef] text-[#197379]"><svg
                                width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="7" y="7" width="10" height="15" rx="2" />
                                <path d="M10 7V2m1 9h2m-3 4h4M4 9a7 7 0 0 0 0 8m16-8a7 7 0 0 1 0 8" />
                            </svg></span></div>
                    <h3 class="text-2xl font-bold leading-tight">Communications &amp; Radio Systems</h3>
                    <p class="mt-4 min-h-[115px] text-sm leading-6 text-muted">Two-way radio and communication
                        systems that keep teams connected on site.</p><a href="#services"
                        class="mt-7 inline-flex items-center gap-2 text-sm font-bold text-[#197379]">View
                        service<svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a>
                </div>
                <div class="tech-panel tech-panel-6">
                    <p class="text-xs font-bold tracking-wider text-[#197379]">06 — SELECTED</p>
                    <div class="mt-6"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef] text-[#197379]"><svg
                                width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m3 6 13 3-2 7L2 12Z M15 10h5v5h-6M7 15v6m-4 0h8" />
                            </svg></span></div>
                    <h3 class="text-2xl font-bold leading-tight">Server, Storage &amp; Backup Infrastructure</h3>
                    <p class="mt-4 min-h-[115px] text-sm leading-6 text-muted">Secure servers, storage and backup
                        that protect your data and keep systems running.</p><a href="#services"
                        class="mt-7 inline-flex items-center gap-2 text-sm font-bold text-[#197379]">View
                        service<svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a>
                </div>
                <div class="mt-7 space-y-1 border-t border-[#dfe2e7] pt-5"><label for="tech-zone-1"
                        class="tech-selector tech-select-1"><span class="mr-3 font-bold text-[#197379]">01</span>Network
                        &amp; Wi-Fi</label><label for="tech-zone-2" class="tech-selector tech-select-2"><span
                            class="mr-3 font-bold text-[#197379]">02</span>Access control</label><label for="tech-zone-3"
                        class="tech-selector tech-select-3"><span class="mr-3 font-bold text-[#197379]">03</span>CCTV
                        &amp; surveillance</label><label for="tech-zone-4" class="tech-selector tech-select-4"><span
                            class="mr-3 font-bold text-[#197379]">04</span>Intrusion &amp; alarm</label><label
                        for="tech-zone-5" class="tech-selector tech-select-5"><span
                            class="mr-3 font-bold text-[#197379]">05</span>Communications &amp; radio</label><label
                        for="tech-zone-6" class="tech-selector tech-select-6"><span
                            class="mr-3 font-bold text-[#197379]">06</span>Server &amp; backup room</label></div>
            </div>
        </div>
    </section>
    <section id="services" class="section bg-[#eff5f6]">
        <div class="container">
            <p class="eyebrow text-[#197379]"><span></span>SERVICES</p>
            <h2>Complete services, one technology<br class="hidden lg:block"> partner.</h2>
            <p class="section-intro max-w-[1050px]">From the cabling in your walls to the support desk you call,
                GAGE Technology designs, installs and supports it all.</p>
            @include('frontend.components.service-cards', ['services' => $services, 'theme' => 'technology'])
        </div>
    </section>
    <section class="section container">
        <p class="eyebrow text-[#197379]"><span></span>HOW WE DELIVER</p>
        <h2>From survey to support.</h2>
        <ol class="mt-16 grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
            <li><span
                    class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#197379] text-base font-bold text-white">01</span>
                <h3 class="mt-7 text-lg font-bold">Survey &amp; design</h3>
                <p class="mt-3 text-sm leading-6 text-muted">We assess your site and design a system around how you
                    operate.</p>
            </li>
            <li><span
                    class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#197379] text-base font-bold text-white">02</span>
                <h3 class="mt-7 text-lg font-bold">Supply &amp; install</h3>
                <p class="mt-3 text-sm leading-6 text-muted">Certified engineers install equipment to standard, with
                    minimal disruption.</p>
            </li>
            <li><span
                    class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#197379] text-base font-bold text-white">03</span>
                <h3 class="mt-7 text-lg font-bold">Commission &amp; handover</h3>
                <p class="mt-3 text-sm leading-6 text-muted">Every system is tested, documented and handed over with
                    training.</p>
            </li>
            <li><span
                    class="inline-flex h-14 w-14 items-center justify-center rounded-full bg-[#197379] text-base font-bold text-white">04</span>
                <h3 class="mt-7 text-lg font-bold">Support &amp; AMC</h3>
                <p class="mt-3 text-sm leading-6 text-muted">Managed support and preventive maintenance keep
                    everything running.</p>
            </li>
        </ol>
        <div class="mt-[120px]">
            <p class="eyebrow text-[#197379]"><span></span>WHO WE SERVE</p>
            <h2>Built for the way the Maldives works.</h2>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <article class="rounded-[16px] border border-[#dfe2e7] p-8"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef] text-[#197379]"><svg
                            width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="4" y="3" width="16" height="7" rx="2" />
                            <rect x="4" y="14" width="16" height="7" rx="2" />
                            <path d="M7 6h2m-2 11h2" />
                        </svg></span>
                    <h3 class="text-xl font-bold">Resorts</h3>
                    <p class="mt-3 text-base leading-7 text-muted">Guest Wi-Fi, back-of-house networks, CCTV, access
                        control and radio — across islands and jetties.</p>
                </article>
                <article class="rounded-[16px] border border-[#dfe2e7] p-8"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef] text-[#197379]"><svg
                            width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="9" y="2" width="6" height="6" rx="1" />
                            <rect x="2" y="16" width="6" height="6" rx="1" />
                            <rect x="16" y="16" width="6" height="6" rx="1" />
                            <path d="M12 8v5H5v3m7-3h7v3" />
                        </svg></span>
                    <h3 class="text-xl font-bold">Businesses</h3>
                    <p class="mt-3 text-base leading-7 text-muted">Offices, retail and warehouses that need reliable
                        IT, secure networks and surveillance.</p>
                </article>
                <article class="rounded-[16px] border border-[#dfe2e7] p-8"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e0edef] text-[#197379]"><svg
                            width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m3 6 13 3-2 7L2 12Z M15 10h5v5h-6M7 15v6m-4 0h8" />
                        </svg></span>
                    <h3 class="text-xl font-bold">Institutions</h3>
                    <p class="mt-3 text-base leading-7 text-muted">Banks, schools, healthcare and public buildings
                        with demanding security and uptime needs.</p>
                </article>
            </div>
        </div>
        <div
            class="mt-[120px] flex flex-col justify-between gap-9 rounded-[24px] bg-[#197379] px-9 py-16 text-white lg:flex-row lg:items-center lg:px-16">
            <div>
                <h2 class="!mt-0">Let’s plan your system.</h2>
                <p class="mt-5 max-w-[740px] text-base leading-7 text-white/80">Tell us about your property and what
                    you need to connect or protect. Our<br class="hidden xl:block"> engineers will recommend the
                    right solution.</p>
            </div>
            <div class="flex flex-col gap-3 lg:min-w-[320px]"><a href="./conact.html#enquiry"
                    class="button button-light !text-[#197379]">Request a site survey<svg width="17" height="17"
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
