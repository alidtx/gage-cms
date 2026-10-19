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
                ['text' => 'Dependable', 'break_class' => ''],
                ['text' => 'protection for people', 'break_class' => 'hidden lg:block'],
                ['text' => 'and property.'],
            ],
            'description' =>
                'Through a seamless blend of elite manpower, specialised event security and advanced surveillance technology, GAGE Security safeguards the places and people that matter most — with precision and discretion.',
            'description_class' => 'mt-6 max-w-[620px] text-lg leading-[1.7] text-[#b9bec4]',
            'logo' => ['src' => 'assets/security-hero-logo.png', 'alt' => 'GAGE Security'],
            'image' => [
                'src' => 'assets/security-page-0.jpg',
                'width' => 841,
                'height' => 1126,
                'alt' => 'GAGE security officers protecting a Maldives resort at dusk',
                'class' => 'aspect-[.86] w-full rounded-[16px] object-cover',
            ],
            'buttons' => [
                [
                    'label' => 'Request a security assessment',
                    'url' => '/contact#enquiry',
                    'class' => 'button button-light',
                    'arrow' => 'yes',
                ],
                [
                    'label' => 'View services',
                    'url' => '#services',
                    'class' => 'button button-outline',
                    'arrow' => 'no',
                ],
            ],
            'breadcrumb' => [
                'title' => 'GAGE Security',
                'class' => 'mb-10 flex flex-wrap gap-2 text-xs leading-6 text-[#b9bec4]',
                'parents' => [['label' => 'Our Companies', 'url' => route('frontend.home') . '#companies']],
            ],
        ], $heroContent),
    ])
    <section id="services" class="section container">
        <p class="eyebrow"><span></span>SERVICES</p>
        <h2>Services that keep you protected.</h2>
        <p class="section-intro max-w-[960px]">From a single guard post to a full security operation, every service is
            planned around your site, your<br class="hidden lg:block"> people and your risks.</p>
        @include('frontend.components.service-cards', ['services' => $services, 'theme' => 'security'])
    </section>
    <section class="bg-[#111315] text-white">
        <div class="section container">
            <p class="eyebrow"><span></span>HOW WE WORK</p>
            <h2>From assessment to everyday<br class="hidden sm:block"> protection.</h2>
            <ol class="security-process mt-16 grid gap-10 sm:grid-cols-2 lg:grid-cols-5 lg:gap-6">
                <li class="relative"><span
                        class="process-number relative z-10 flex h-14 w-14 items-center justify-center rounded-full bg-white text-base font-bold text-black">01</span>
                    <h3 class="mt-7 text-lg font-bold">Security assessment</h3>
                    <p class="mt-3 text-base leading-7 text-[#9aa0a7]">We visit your site, understand your operations and
                        identify the risks that matter.</p>
                </li>
                <li class="relative"><span
                        class="process-number relative z-10 flex h-14 w-14 items-center justify-center rounded-full bg-white text-base font-bold text-black">02</span>
                    <h3 class="mt-7 text-lg font-bold">Tailored plan</h3>
                    <p class="mt-3 text-base leading-7 text-[#9aa0a7]">You receive a clear proposal: manpower, systems,
                        procedures and reporting.</p>
                </li>
                <li class="relative"><span
                        class="process-number relative z-10 flex h-14 w-14 items-center justify-center rounded-full bg-white text-base font-bold text-black">03</span>
                    <h3 class="mt-7 text-lg font-bold">Trained deployment</h3>
                    <p class="mt-3 text-base leading-7 text-[#9aa0a7]">Officers are briefed on your site, your guests and
                        your standards before day one.</p>
                </li>
                <li class="relative"><span
                        class="process-number relative z-10 flex h-14 w-14 items-center justify-center rounded-full bg-white text-base font-bold text-black">04</span>
                    <h3 class="mt-7 text-lg font-bold">Supervision & reporting</h3>
                    <p class="mt-3 text-base leading-7 text-[#9aa0a7]">Experienced supervisors check standards and keep you
                        informed.</p>
                </li>
                <li class="relative"><span
                        class="process-number relative z-10 flex h-14 w-14 items-center justify-center rounded-full bg-white text-base font-bold text-black">05</span>
                    <h3 class="mt-7 text-lg font-bold">Review & improve</h3>
                    <p class="mt-3 text-base leading-7 text-[#9aa0a7]">We review performance with you and adapt as your
                        needs change.</p>
                </li>
            </ol>
        </div>
    </section>
    <section class="section container">
        <div class="grid items-start gap-12 lg:grid-cols-2 lg:gap-24"><img src="./public/assets/security-page-1.jpg"
                alt="GAGE security supervisor briefing a team of uniformed officers"
                class="aspect-[1.33] w-full rounded-[16px] object-cover" loading="lazy">
            <div>
                <p class="eyebrow"><span></span>WHY GAGE SECURITY</p>
                <h2>Standards you can see in<br class="hidden lg:block"> every officer.</h2>
                <p class="section-intro">Our officers are selected, trained and supervised to represent your organisation
                    with professionalism and discretion.</p>
                <ul class="mt-6 space-y-4 text-base leading-7 text-muted">
                    <li class="flex items-start gap-3"><span
                            class="mt-1 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#e9ebef] text-sm font-bold text-black"
                            aria-hidden="true">✓</span>Quality management certified to ISO 9001:2015</li>
                    <li class="flex items-start gap-3"><span
                            class="mt-1 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#e9ebef] text-sm font-bold text-black"
                            aria-hidden="true">✓</span>Officers trained through GAGE Training Institute, home of the
                        MQA-approved Certificate I in Security Officer Training</li>
                    <li class="flex items-start gap-3"><span
                            class="mt-1 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#e9ebef] text-sm font-bold text-black"
                            aria-hidden="true">✓</span>Experienced supervisors and managers on every contract</li>
                    <li class="flex items-start gap-3"><span
                            class="mt-1 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-[#e9ebef] text-sm font-bold text-black"
                            aria-hidden="true">✓</span>Trusted by top resorts, banks and diplomatic missions</li>
                </ul>
            </div>
        </div>
        <div class="mt-24">
            <p class="text-xs font-bold tracking-wider text-[#9aa0a7]">SOLUTIONS WE DELIVER FOR</p>
            <div class="mt-5 flex flex-wrap gap-3"><a href="./Sector-Solution-Resorts-and-Hotels.html"
                    class="rounded-full border border-[#dfe2e7] px-4 py-2 text-xs font-bold">Resorts & Hotels</a><a
                    href="./index.html#solutions"
                    class="rounded-full border border-[#dfe2e7] px-4 py-2 text-xs font-bold">Banks & Diplomatic
                    Missions</a><a href="./index.html#solutions"
                    class="rounded-full border border-[#dfe2e7] px-4 py-2 text-xs font-bold">Industrial, Fuel &
                    Utilities</a><a href="./index.html#solutions"
                    class="rounded-full border border-[#dfe2e7] px-4 py-2 text-xs font-bold">Residential & Mixed-use</a><a
                    href="./index.html#solutions"
                    class="rounded-full border border-[#dfe2e7] px-4 py-2 text-xs font-bold">Public Facilities</a></div>
        </div>
    </section>
    <section id="contact" class="container pb-[120px]">
        <div
            class="flex flex-col justify-between gap-9 rounded-[24px] bg-black px-9 py-16 text-white lg:flex-row lg:items-center lg:px-16">
            <div>
                <h2 class="!mt-0">Talk to our security team.</h2>
                <p class="mt-4 max-w-[740px] text-base leading-7 text-[#b9bec4]">Tell us what you need to protect.
                    Our team will recommend the right mix of security,<br class="hidden xl:block"> fire safety,
                    training and technology — and give you a clear proposal.</p>
            </div>
            <div class="flex min-w-[290px] flex-col gap-3">
                <a href="./conact.html" class="button button-light">Request a security assessment<svg
                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
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
