@extends('frontend.layouts.app')
@section('content')
    @include('frontend.components.hero', [
        'hero' => \App\Services\FrontendHero::merge([
            'variant' => 'home',
            'container_class' => 'container grid items-center gap-12 py-16 lg:grid-cols-2 lg:gap-24',
            'section_class' => 'home-hero bg-black text-white ZoomOutAnimation',
            'eyebrow' => 'EXPERTS IN SAFETY & SECURITY',
            'heading' => [['text' => 'Protecting'], ['text' => 'Maldives since'], ['text' => '2010.']],
            'heading_class' => 'mt-7 text-[44px] font-bold leading-[1.06] tracking-[-1.6px] sm:text-[68px]',
            'description' =>
                'Security, fire safety, training and technology from one trusted partner — for resorts, banks, diplomatic missions and businesses across the Maldives.',
            'description_class' => 'mt-7 max-w-[560px] text-lg leading-[1.65] text-[#b9bec4]',
            'image' => [
                'src' => 'assets/pdf-1.jpg',
                'width' => 864,
                'height' => 864,
                'alt' => 'GAGE security professional walking along a Maldives resort jetty at dusk',
                'class' => 'aspect-[1.05] w-full rounded-[20px] object-cover',
            ],
            'buttons' => [
                [
                    'label' => 'Get Protected Now',
                    'url' => route('contact.create'),
                    'class' => 'button button-light',
                ],
                [
                    'label' => 'Explore our companies',
                    'url' => route('frontend.home') . '#companies',
                    'class' => 'button button-outline',
                    'arrow' => 'no',
                ],
            ],
        ], $heroContent),
    ])
    <section aria-label="GAGE credentials" class="border-b border-[#dce0e5] ZoomOutAnimation">
        <div class="container grid gap-8 py-10 sm:grid-cols-2 lg:grid-cols-4 lg:gap-0">
            <div class="flex gap-4 lg:border-r lg:border-[#e3e5e9] lg:px-7 first:pl-0 last:border-0 last:pr-0">
                <span class="icon-box">
                    <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-calendar">
                        <path d="M8 2v4">
                        </path>
                        <path d="M16 2v4">
                        </path>
                        <rect width="18" height="18" x="3" y="4" rx="2">
                        </rect>
                        <path d="M3 10h18">
                        </path>
                    </svg>
                </span>
                <div>
                    <h3 class="text-[22px] font-bold whitespace-nowrap">Since 2010</h3>
                    <p class="mt-1 text-sm leading-5 text-muted">Founded by former Commissioner of Police Abdulla
                        Riyaz</p>
                </div>
            </div>
            <div class="flex gap-4 lg:border-r lg:border-[#e3e5e9] lg:px-7 first:pl-0 last:border-0 last:pr-0">
                <span class="gold-mark">GOLD<strong>100</strong>
                </span>
                <div>
                    <h3 class="text-[22px] font-bold whitespace-nowrap">3× GOLD100</h3>
                    <p class="mt-1 text-sm leading-5 text-muted">Three consecutive wins of the Maldives’ most
                        prestigious business award</p>
                </div>
            </div>
            <div class="flex gap-4 lg:border-r lg:border-[#e3e5e9] lg:px-7 first:pl-0 last:border-0 last:pr-0">
                <span class="iso-mark">ISO<small>9001:2015<br>CERTIFIED</small>
                </span>
                <div>
                    <h3 class="text-[22px] font-bold whitespace-nowrap">ISO 9001:2015</h3>
                    <p class="mt-1 text-sm leading-5 text-muted">Certified quality management system</p>
                </div>
            </div>
            <div class="flex gap-4 lg:border-r lg:border-[#e3e5e9] lg:px-7 first:pl-0 last:border-0 last:pr-0">
                <span class="icon-box">
                    <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layers">
                        <path
                            d="M12.83 2.18a2 2 0 0 0-1.66 0L2.6 6.08a1 1 0 0 0 0 1.83l8.58 3.91a2 2 0 0 0 1.66 0l8.58-3.9a1 1 0 0 0 0-1.83z">
                        </path>
                        <path d="M2 12a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 12">
                        </path>
                        <path d="M2 17a1 1 0 0 0 .58.91l8.6 3.91a2 2 0 0 0 1.65 0l8.58-3.9A1 1 0 0 0 22 17">
                        </path>
                    </svg>
                </span>
                <div>
                    <h3 class="text-[22px] font-bold whitespace-nowrap">5 companies</h3>
                    <p class="mt-1 text-sm leading-5 text-muted">One partner for every layer of protection</p>
                </div>
            </div>
        </div>
    </section>
    <section id="companies" class="section container">
        <p class="eyebrow">
            <span>
            </span>OUR COMPANIES
        </p>
        <h2>One group. Specialist<br class="hidden sm:block"> companies.</h2>
        <p class="section-intro">Each GAGE company is an expert in its field. Together, they protect every layer of
            your<br class="hidden lg:block"> property — people, assets, systems and skills.</p>
        @include('frontend.components.entity-cards', ['entities' => $entities])
        <div
            class="mt-6 flex flex-col items-start gap-6 rounded-[16px] bg-[#442424] p-7 text-white sm:flex-row sm:items-center">
            <div class="shrink-0 text-center">
                <img width="302" height="184" loading="lazy" decoding="async" class="h-20 w-24 object-cover"
                    alt="" src="{{ asset('assets/security.png') }}">
                <span class="text-[10px] tracking-[5px]">STORE</span>
            </div>
            <div class="flex-1">
                <h3 class="text-2xl font-bold">Safety &amp; security products, now online.</h3>
                <p class="mt-2 max-w-[730px] text-sm leading-6 text-[#d6cfcf]">Fire safety equipment, CCTV,
                    firefighting gear, pumps, networking and more — from the GAGE Store in Malé or at
                    shop.gage.com.mv.</p>
            </div>
            <a href="https://shop.gage.com.mv" target="_blank" rel="noreferrer"
                class="button button-light shrink-0 text-xs">Shop at shop.gage.com.mv<svg
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-arrow-up-right">
                    <path d="M7 7h10v10">
                    </path>
                    <path d="M7 17 17 7">
                    </path>
                </svg>
            </a>
        </div>
    </section>
    <section id="about" class="bg-[#f4f5f7] ZoomOutAnimation">
        <div class="container section">
            <p class="eyebrow">
                <span>
                </span>WHY CHOOSE US
            </p>
            <h2>The leading safety &amp; security service<br class="hidden lg:block"> provider in the Maldives.</h2>
            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <article class="rounded-[16px] border border-[#ebedf0] bg-white p-8 ZoomOutAnimation">
                    <span class="icon-box">
                        <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2">
                            </path>
                            <circle cx="9" cy="7" r="4">
                            </circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87">
                            </path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75">
                            </path>
                        </svg>
                    </span>
                    <h3 class="mt-6 text-lg font-bold">Consistently trained professionals</h3>
                    <p class="mt-2 text-sm leading-[1.65] text-muted">Our people train continuously — many through
                        our own GAGE Training Institute.</p>
                </article>
                <article class="rounded-[16px] border border-[#ebedf0] bg-white p-8 ZoomOutAnimation">
                    <span class="icon-box">
                        <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-handshake">
                            <path d="m11 17 2 2a1 1 0 1 0 3-3">
                            </path>
                            <path
                                d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4">
                            </path>
                            <path d="m21 3 1 11h-2">
                            </path>
                            <path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3">
                            </path>
                            <path d="M3 4h8">
                            </path>
                        </svg>
                    </span>
                    <h3 class="mt-6 text-lg font-bold">Adaptive client partnership</h3>
                    <p class="mt-2 text-sm leading-[1.65] text-muted">Every service is shaped around your property,
                        your guests and your operations.</p>
                </article>
                <article class="rounded-[16px] border border-[#ebedf0] bg-white p-8 ZoomOutAnimation">
                    <span class="icon-box">
                        <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award">
                            <path
                                d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526">
                            </path>
                            <circle cx="12" cy="8" r="6">
                            </circle>
                        </svg>
                    </span>
                    <h3 class="mt-6 text-lg font-bold">Unmatched service excellence</h3>
                    <p class="mt-2 text-sm leading-[1.65] text-muted">Recognised with the GOLD100 award, the
                        Maldives’ most prestigious business award, three years running.</p>
                </article>
                <article class="rounded-[16px] border border-[#ebedf0] bg-white p-8 ZoomOutAnimation">
                    <span class="icon-box">
                        <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock">
                            <circle cx="12" cy="12" r="10">
                            </circle>
                            <polyline points="12 6 12 12 16 14">
                            </polyline>
                        </svg>
                    </span>
                    <h3 class="mt-6 text-lg font-bold">Reliable round-the-clock</h3>
                    <p class="mt-2 text-sm leading-[1.65] text-muted">Protection and support that doesn’t stop when
                        the working day does.</p>
                </article>
                <article class="rounded-[16px] border border-[#ebedf0] bg-white p-8 ZoomOutAnimation">
                    <span class="icon-box">
                        <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clipboard-check">
                            <rect width="8" height="4" x="8" y="2" rx="1" ry="1">
                            </rect>
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                            </path>
                            <path d="m9 14 2 2 4-4">
                            </path>
                        </svg>
                    </span>
                    <h3 class="mt-6 text-lg font-bold">Expertly managed solutions</h3>
                    <p class="mt-2 text-sm leading-[1.65] text-muted">Experienced managers oversee every contract,
                        from first assessment to daily delivery.</p>
                </article>
                <article class="rounded-[16px] border border-[#ebedf0] bg-white p-8 ZoomOutAnimation">
                    <span class="icon-box">
                        <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-badge-check">
                            <path
                                d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z">
                            </path>
                            <path d="m9 12_2_2_4-4">
                            </path>
                        </svg>
                    </span>
                    <h3 class="mt-6 text-lg font-bold">Unwavering quality commitment</h3>
                    <p class="mt-2 text-sm leading-[1.65] text-muted">Quality management certified to ISO 9001:2015.
                    </p>
                </article>
            </div>
        </div>
    </section>
    <section id="solutions" class="section container ZoomOutAnimation">
        <p class="eyebrow">
            <span>
            </span>SOLUTIONS
        </p>
        <h2>Protection designed around your<br class="hidden sm:block"> property.</h2>
        <p class="section-intro">Tell us what kind of place you run. We’ll bring the right mix of our companies to
            protect it.</p>
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
            <article class="flex flex-col rounded-[14px] border border-[#dfe2e7] p-6">
                <span class="icon-box">
                    <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hotel">
                        <path d="M10 22v-6.57">
                        </path>
                        <path d="M12 11h.01">
                        </path>
                        <path d="M12 7h.01">
                        </path>
                        <path d="M14 15.43V22">
                        </path>
                        <path d="M15 16a5 5 0 0 0-6 0">
                        </path>
                        <path d="M16 11h.01">
                        </path>
                        <path d="M16 7h.01">
                        </path>
                        <path d="M8 11h.01">
                        </path>
                        <path d="M8 7h.01">
                        </path>
                        <rect x="4" y="2" width="16" height="20" rx="2">
                        </rect>
                    </svg>
                </span>
                <h3 class="mt-7 min-h-14 text-lg font-bold leading-6">Resorts &amp; Hotels</h3>
                <p class="mt-2 flex-1 text-sm leading-[1.65] text-muted">Guards, fire systems, staff training and
                    connectivity for island properties.</p>
                <a class="mt-7 inline-flex items-center gap-2 text-sm font-bold"
                    href="mailto:info@gage.com.mv?subject=Resorts%20%26%20Hotels%20protection%20enquiry">Explore<svg
                        xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-right">
                        <path d="M5 12h14">
                        </path>
                        <path d="m12 5 7 7-7 7">
                        </path>
                    </svg>
                </a>
            </article>
            <article class="flex flex-col rounded-[14px] border border-[#dfe2e7] p-6">
                <span class="icon-box">
                    <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-landmark">
                        <line x1="3" x2="21" y1="22" y2="22">
                        </line>
                        <line x1="6" x2="6" y1="18" y2="11">
                        </line>
                        <line x1="10" x2="10" y1="18" y2="11">
                        </line>
                        <line x1="14" x2="14" y1="18" y2="11">
                        </line>
                        <line x1="18" x2="18" y1="18" y2="11">
                        </line>
                        <polygon points="12 2 20 7 4 7">
                        </polygon>
                    </svg>
                </span>
                <h3 class="mt-7 min-h-14 text-lg font-bold leading-6">Banks &amp; Diplomatic Missions</h3>
                <p class="mt-2 flex-1 text-sm leading-[1.65] text-muted">Discreet, high-assurance security, cash in
                    transit and fire protection.</p>
                <a class="mt-7 inline-flex items-center gap-2 text-sm font-bold"
                    href="mailto:info@gage.com.mv?subject=Banks%20%26%20Diplomatic%20Missions%20protection%20enquiry">Explore<svg
                        xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-right">
                        <path d="M5 12h14">
                        </path>
                        <path d="m12 5 7 7-7 7">
                        </path>
                    </svg>
                </a>
            </article>
            <article class="flex flex-col rounded-[14px] border border-[#dfe2e7] p-6">
                <span class="icon-box">
                    <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-factory">
                        <path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z">
                        </path>
                        <path d="M17 18h1">
                        </path>
                        <path d="M12 18h1">
                        </path>
                        <path d="M7 18h1">
                        </path>
                    </svg>
                </span>
                <h3 class="mt-7 min-h-14 text-lg font-bold leading-6">Industrial, Fuel &amp; Utilities</h3>
                <p class="mt-2 flex-1 text-sm leading-[1.65] text-muted">Fire protection and security for power
                    houses, fuel farms and warehouses.</p>
                <a class="mt-7 inline-flex items-center gap-2 text-sm font-bold"
                    href="mailto:info@gage.com.mv?subject=Industrial%2C%20Fuel%20%26%20Utilities%20protection%20enquiry">Explore<svg
                        xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-right">
                        <path d="M5 12h14">
                        </path>
                        <path d="m12 5 7 7-7 7">
                        </path>
                    </svg>
                </a>
            </article>
            <article class="flex flex-col rounded-[14px] border border-[#dfe2e7] p-6">
                <span class="icon-box">
                    <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building2">
                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z">
                        </path>
                        <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2">
                        </path>
                        <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2">
                        </path>
                        <path d="M10 6h4">
                        </path>
                        <path d="M10 10h4">
                        </path>
                        <path d="M10 14h4">
                        </path>
                        <path d="M10 18h4">
                        </path>
                    </svg>
                </span>
                <h3 class="mt-7 min-h-14 text-lg font-bold leading-6">Residential &amp; Mixed-use</h3>
                <p class="mt-2 flex-1 text-sm leading-[1.65] text-muted">Fire systems, alarms and access control for
                    high-rise and mixed-use buildings.</p>
                <a class="mt-7 inline-flex items-center gap-2 text-sm font-bold"
                    href="mailto:info@gage.com.mv?subject=Residential%20%26%20Mixed-use%20protection%20enquiry">Explore<svg
                        xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-right">
                        <path d="M5 12h14">
                        </path>
                        <path d="m12 5 7 7-7 7">
                        </path>
                    </svg>
                </a>
            </article>
            <article class="flex flex-col rounded-[14px] border border-[#dfe2e7] p-6">
                <span class="icon-box">
                    <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plane">
                        <path
                            d="M17.8 19.2 16 11l3.5-3.5C21 6 21.5 4 21 3c-1-.5-3 0-4.5 1.5L13 8 4.8 6.2c-.5-.1-.9.1-1.1.5l-.3.5c-.2.5-.1 1 .3 1.3L9 12l-2 3H4l-1 1 3 2 2 3 1-1v-3l3-2 3.5 5.3c.3.4.8.5 1.3.3l.5-.2c.4-.3.6-.7.5-1.2z">
                        </path>
                    </svg>
                </span>
                <h3 class="mt-7 min-h-14 text-lg font-bold leading-6">Public Facilities</h3>
                <p class="mt-2 flex-1 text-sm leading-[1.65] text-muted">Safety systems and training for airports,
                    schools and healthcare facilities.</p>
                <a class="mt-7 inline-flex items-center gap-2 text-sm font-bold"
                    href="mailto:info@gage.com.mv?subject=Public%20Facilities%20protection%20enquiry">Explore<svg
                        xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-right">
                        <path d="M5 12h14">
                        </path>
                        <path d="m12 5 7 7-7 7">
                        </path>
                    </svg>
                </a>
            </article>
        </div>
        <div id="projects" class="mt-[120px] grid overflow-hidden rounded-[24px] bg-black text-white lg:grid-cols-2">
            <div class="p-9 sm:p-16">
                <p class="eyebrow">
                    <span>
                    </span>PROJECTS &amp; CLIENTS
                </p>
                <h2 class="mt-6">Trusted across the<br> atolls.</h2>
                <p class="mt-5 text-lg leading-[1.65] text-[#b9bec4]">From Haa Alifu to Gaafu Alifu, GAGE protects
                    many of the Maldives’ best-known resorts, banks, hospitals and public buildings.</p>
                <div class="my-10 grid grid-cols-2 gap-6">
                    <div class="border-t-2 border-white pt-6">
                        <strong class="text-[52px] leading-none">32</strong>
                        <p class="mt-2 text-sm leading-5 text-[#b9bec4]">resorts with fire safety systems installed
                            by GAGE</p>
                    </div>
                    <div class="border-t-2 border-white pt-6">
                        <strong class="text-[52px] leading-none">21</strong>
                        <p class="mt-2 text-sm leading-5 text-[#b9bec4]">selected buildings and facilities</p>
                    </div>
                </div>
                <a href="{{ route('frontend.home') }}#clients" class="button button-light">View projects &amp; clients<svg
                        xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-arrow-right">
                        <path d="M5 12h14">
                        </path>
                        <path d="m12 5 7 7-7 7">
                        </path>
                    </svg>
                </a>
            </div>
            <img width="640" height="648" decoding="async" class="h-full min-h-[420px] w-full object-cover"
                alt="Map of Maldives atolls showing GAGE project locations" loading="lazy"
                src="{{ asset('assets/map.png') }}">
        </div>
        <div id="clients" class="relative mt-24">
            <p class="mb-6 text-center text-base font-bold">Trusted by leading resorts, banks and diplomatic
                missions</p>
            <div class="brand-carousel" data-brand-carousel role="region" aria-label="Trusted clients">
                <button class="brand-carousel-arrow" type="button" data-brand-previous aria-label="Previous clients"
                    aria-controls="home-client-track" disabled><span aria-hidden="true">&#8592;</span></button>
                <div class="brand-carousel-track" id="home-client-track" tabindex="0" aria-label="Client logos">
                    <div
                        class="flex h-[82px] items-center justify-center rounded-lg border border-[#dfe2e7] bg-white px-5">
                        <img width="196" height="110" decoding="async"
                            class="max-h-[64px] max-w-full object-contain" alt="Heritance Aarah" loading="lazy"
                            src="{{ asset('assets/pdf-12.jpg') }}">
                    </div>
                    <div
                        class="flex h-[82px] items-center justify-center rounded-lg border border-[#dfe2e7] bg-white px-5">
                        <img width="187" height="86" decoding="async"
                            class="max-h-[64px] max-w-full object-contain" alt="Miechi" loading="lazy"
                            src="{{ asset('assets/pdf-13.jpg') }}">
                    </div>
                    <div
                        class="flex h-[82px] items-center justify-center rounded-lg border border-[#dfe2e7] bg-white px-5">
                        <img width="147" height="147" decoding="async"
                            class="max-h-[64px] max-w-full object-contain" alt="RIU Hotels &amp; Resorts" loading="lazy"
                            src="{{ asset('assets/pdf-0.png') }}">
                    </div>
                    <div
                        class="flex h-[82px] items-center justify-center rounded-lg border border-[#dfe2e7] bg-white px-5">
                        <img width="202" height="121" decoding="async"
                            class="max-h-[64px] max-w-full object-contain" alt="NH Collection" loading="lazy"
                            src="{{ asset('assets/pdf-14.png') }}">
                    </div>
                    <div
                        class="flex h-[82px] items-center justify-center rounded-lg border border-[#dfe2e7] bg-white px-5">
                        <img width="177" height="99" decoding="async"
                            class="max-h-[64px] max-w-full object-contain" alt="Taj Exotica" loading="lazy"
                            src="{{ asset('assets/pdf-15.jpg') }}">
                    </div>
                    <div
                        class="flex h-[82px] items-center justify-center rounded-lg border border-[#dfe2e7] bg-white px-5">
                        <img width="197" height="139" decoding="async"
                            class="max-h-[64px] max-w-full object-contain" alt="Adaaran Meedhupparu" loading="lazy"
                            src="{{ asset('assets/pdf-11.jpg') }}">
                    </div>
                    <div
                        class="flex h-[82px] items-center justify-center rounded-lg border border-[#dfe2e7] bg-white px-5">
                        <img width="113" height="88" decoding="async"
                            class="max-h-[64px] max-w-full object-contain" alt="Dhivehi Insurance" loading="lazy"
                            src="{{ asset('assets/pdf-6.jpg') }}">
                    </div>
                    <div
                        class="flex h-[82px] items-center justify-center rounded-lg border border-[#dfe2e7] bg-white px-5">
                        <img width="187" height="187" decoding="async"
                            class="max-h-[64px] max-w-full object-contain" alt="Renaatus" loading="lazy"
                            src="{{ asset('assets/pdf-5.jpg') }}">
                    </div>
                    <div
                        class="flex h-[82px] items-center justify-center rounded-lg border border-[#dfe2e7] bg-white px-5">
                        <img width="267" height="101" decoding="async"
                            class="max-h-[64px] max-w-full object-contain" alt="Ooredoo" loading="lazy"
                            src="{{ asset('assets/pdf-7.png') }}">
                    </div>
                    <div
                        class="flex h-[82px] items-center justify-center rounded-lg border border-[#dfe2e7] bg-white px-5">
                        <img width="154" height="97" decoding="async"
                            class="max-h-[64px] max-w-full object-contain" alt="SIBCO" loading="lazy"
                            src="{{ asset('assets/pdf-4.png') }}">
                    </div>
                    <div
                        class="flex h-[82px] items-center justify-center rounded-lg border border-[#dfe2e7] bg-white px-5">
                        <img width="187" height="63" decoding="async"
                            class="max-h-[64px] max-w-full object-contain" alt="Velana International Airport"
                            loading="lazy" src="{{ asset('assets/pdf-3.png') }}">
                    </div>
                    <div
                        class="flex h-[82px] items-center justify-center rounded-lg border border-[#dfe2e7] bg-white px-5">
                        <img width="187" height="125" decoding="async"
                            class="max-h-[64px] max-w-full object-contain" alt="Alkatas" loading="lazy"
                            src="{{ asset('assets/pdf-2.jpg') }}">
                    </div>
                </div>
                <button class="brand-carousel-arrow" type="button" data-brand-next aria-label="Next clients"
                    aria-controls="home-client-track"><span aria-hidden="true">&#8594;</span></button>
            </div>
        </div>
    </section>
    <section id="news" class="container pb-[120px] ZoomOutAnimation">
        <p class="eyebrow"><span></span>NEWS</p>
        <div class="flex items-end justify-between gap-5">
            <h2>Latest from GAGE</h2>
            <a href="{{ route('frontend.news') }}" class="mb-2 inline-flex items-center gap-2 text-sm font-bold">View all
                news →</a>
        </div>
        <div class="mt-8 grid gap-7 md:grid-cols-3">
            @forelse($recentNews as $article)
                <article>
                    <a class="block w-full overflow-hidden rounded-[14px]"
                        href="{{ route('frontend.news.show', $article->slug) }}" aria-label="{{ $article->title }}">
                        @if ($article->featured_image_id)
                            <img decoding="async" alt="{{ $article->title }}"
                                class="aspect-[1.63] w-full object-cover transition-transform duration-500 hover:scale-105"
                                loading="lazy" src="{{ route('frontend.news.image', [$article->slug, 'featured']) }}">
                        @else
                            <div class="public-news-image public-news-placeholder" aria-hidden="true">GAGE NEWS</div>
                        @endif
                    </a>
                    <p class="mt-6 text-[10px] font-bold tracking-wider">● {{ $article->category->name }} · <time
                            datetime="{{ $article->published_at->toDateString() }}">{{ $article->published_at->format('d F Y') }}</time>
                    </p>
                    <h3 class="mt-3 text-xl font-bold leading-[1.4]"><a
                            href="{{ route('frontend.news.show', $article->slug) }}">{{ $article->title }}</a></h3>
                    <p class="mt-3 text-sm leading-[1.65] text-muted">{{ mb_substr($article->excerpt ?? '', 0, 300) }}{{ mb_strlen($article->excerpt ?? '') > 300 ? '…' : '' }}</p>
                    <a class="mt-6 inline-flex items-center gap-2 text-sm font-bold"
                        href="{{ route('frontend.news.show', $article->slug) }}">Read more →</a>
                </article>
            @empty
                <p class="text-muted">News and updates will be available soon.</p>
            @endforelse
        </div>
    </section>
    <section id="contact" class="container pb-[120px] ZoomOutAnimation">
        <div
            class="flex flex-col justify-between gap-9 rounded-[24px] bg-black px-9 py-16 text-white lg:flex-row lg:items-center lg:px-16">
            <div>
                <h2 class="!mt-0">Get Protected Now.</h2>
                <p class="mt-4 max-w-[740px] text-base leading-7 text-[#b9bec4]">Tell us what you need to protect.
                    Our team will recommend the right mix of security,<br class="hidden xl:block"> fire safety,
                    training and technology — and give you a clear proposal.</p>
            </div>
            <div class="flex min-w-[290px] flex-col gap-3">
                <a href="mailto:info@gage.com.mv?subject=Request%20a%20quote" class="button button-light">Request a
                    quote<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="18"
                        height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right">
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
