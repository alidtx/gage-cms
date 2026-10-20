@extends('frontend.layouts.app')
@section('content')
    @include('frontend.components.hero', [
        'hero' => \App\Services\FrontendHero::merge(
            [
                'variant' => 'split',
                'section_class' => 'bg-black text-white ZoomOutAnimation',
                'container_class' => 'container pb-20 pt-10',
                'grid_class' => 'grid items-center gap-14 lg:grid-cols-[1.2fr_1fr] lg:gap-24',
                'heading_class' => 'mt-7 text-[38px] font-bold leading-[1.1] tracking-[-1px] sm:text-[56px]',
                'heading' => [
                    [
                        'text' => 'Physical Security
                         ',
                        'break_class' => 'hidden lg:block',
                    ],
                ],
                'description' =>
                    'Trained, uniformed security officers protecting your people, guests and property around the clock — at resorts, offices, industrial sites, banks and residences across the Maldives.',
                'description_class' => 'mt-6 max-w-[680px] text-lg leading-[1.7] text-[#b9bec4]',
                'eyebrow' => 'GAGE SECURITY · SERVICE',
                'eyebrow_class' => 'eyebrow',
                'image' => [
                    'src' => 'assets/about-0.jpg',
                    'width' => 722,
                    'height' => 1130,
                    'alt' => 'A protective GAGE shield over a Maldives island resort',
                    'class' => 'aspect-[1.45] w-full rounded-[16px] object-cover object-[50%_42%]',
                ],
                'buttons' => [
                    [
                        'label' => 'Request Security Assessment',
                        'url' => route('contact.create'),
                        'class' => 'button button-light',
                    ],
                    [
                        'label' => 'Talk To our Team',
                        'url' => route('contact.create') . '#companies',
                        'class' => 'button button-outline',
                        'arrow' => 'no',
                    ],
                ],
                'breadcrumb' => ['title' => 'Service', 'class' => 'mb-10 flex gap-3 text-xs text-[#b9bec4]'],
            ],
            $heroContent),
    ])  
        <section class="section container">
            <div class="grid items-start gap-12 lg:grid-cols-2 lg:gap-24">
                <div>
                    <p class="eyebrow"><span></span>WHAT’S INCLUDED</p>
                    <h2>Officers on site.<br>Standards you can see.</h2>
                    <div class="mt-6 space-y-5 text-base leading-[1.8] text-muted">
                        <p>Physical security is the foundation of GAGE. Our officers are the visible, trained presence that
                            deters threats, controls who comes and goes, and responds first when something happens.</p>
                        <p>Every deployment is planned around your site — the entrances, the people, the assets and the
                            hours that matter most.</p>
                    </div>
                    <ul class="mt-7 space-y-3 text-sm leading-6 text-muted">
                        <li class="flex gap-3"><span
                                class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e9ebef] text-xs font-extrabold text-black"
                                aria-hidden="true">✓</span>Static guarding of entrances, gates and key areas</li>
                        <li class="flex gap-3"><span
                                class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e9ebef] text-xs font-extrabold text-black"
                                aria-hidden="true">✓</span>Access control for staff, visitors, contractors and vehicles</li>
                        <li class="flex gap-3"><span
                                class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e9ebef] text-xs font-extrabold text-black"
                                aria-hidden="true">✓</span>Foot patrols of your premises at set and random intervals</li>
                        <li class="flex gap-3"><span
                                class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e9ebef] text-xs font-extrabold text-black"
                                aria-hidden="true">✓</span>First response to incidents, alarms and emergencies</li>
                        <li class="flex gap-3"><span
                                class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e9ebef] text-xs font-extrabold text-black"
                                aria-hidden="true">✓</span>Officers trained in basic fire safety and first aid</li>
                        <li class="flex gap-3"><span
                                class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#e9ebef] text-xs font-extrabold text-black"
                                aria-hidden="true">✓</span>Daily occurrence logs and incident reports</li>
                    </ul>
                </div><img src="./public/assets/physical-page-1.jpg"
                    alt="GAGE security officer checking visitor credentials at a resort entrance"
                    class="aspect-[1.08] w-full rounded-[16px] object-cover" loading="lazy">
            </div>
            <div class="mt-[120px]">
                <p class="eyebrow"><span></span>WHO WE SERVE</p>
                <h2>Protection for every kind of property.</h2>
                <p class="section-intro">From island resorts to bank branches, our officers adapt to the standards and
                    culture of your site.</p>
                <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                                width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="5" y="2" width="14" height="20" rx="2" />
                                <path d="M9 6h6m-6 4h6m-6 4h2m1 4v4" />
                            </svg></span>
                        <h3 class="text-lg font-bold leading-6">Resorts &amp; hotels</h3>
                        <p class="mt-3 text-sm leading-6 text-muted">Discreet guarding that protects guests and staff
                            without intruding on the experience.</p>
                    </article>
                    <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                                width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m2 8 10-6 10 6H2Zm2 3v7m5-7v7m6-7v7m5-7v7M2 22h20M2 19h20" />
                            </svg></span>
                        <h3 class="text-lg font-bold leading-6">Banks &amp; diplomatic missions</h3>
                        <p class="mt-3 text-sm leading-6 text-muted">High-assurance officers for sites where discipline and
                            discretion are essential.</p>
                    </article>
                    <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                                width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M3 21V9l6 3V6l6 6h6v9ZM3 9V3h4v8m0 6h1m4 0h1m4 0h1" />
                            </svg></span>
                        <h3 class="text-lg font-bold leading-6">Industrial &amp; utilities</h3>
                        <p class="mt-3 text-sm leading-6 text-muted">Guarding for power houses, fuel farms, warehouses and
                            construction sites.</p>
                    </article>
                    <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                                width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="7" width="18" height="15" rx="1" />
                                <path d="M8 7V2h8v5m-8 4h1m6 0h1m-8 4h1m6 0h1m-4 7v-4" />
                            </svg></span>
                        <h3 class="text-lg font-bold leading-6">Offices &amp; residences</h3>
                        <p class="mt-3 text-sm leading-6 text-muted">Front-of-house security and access control for
                            commercial and residential buildings.</p>
                    </article>
                </div>
            </div>
            <div
                class="mt-[120px] flex flex-col items-start justify-between gap-6 rounded-[16px] bg-black p-10 text-white lg:flex-row lg:items-center">
                <div class="flex items-start gap-6"><span class="hidden sm:block"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                                width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m12 2 8 5v9l-8 6-8-6V7Z m-4 10 3 3 5-6" />
                            </svg></span></span>
                    <div>
                        <h3 class="text-2xl font-bold">Need cover for an event or VIP visit?</h3>
                        <p class="mt-3 max-w-[850px] text-sm leading-6 text-white/70">Add GAGE Event Security or VIP
                            Security to your contract for crowd management, access control and<br class="hidden xl:block">
                            close protection when you need it.</p>
                    </div>
                </div><a href="./GAGE-Security.html#services" class="button button-light">Explore Event Security<svg
                        width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a>
            </div>
        </section>
        <section class="section bg-[#f4f5f7]">
            <div class="container">
                <p class="eyebrow"><span></span>HOW IT WORKS</p>
                <h2>From assessment to everyday<br class="hidden lg:block"> protection.</h2>
                <ol class="physical-process mt-16 grid gap-10 sm:grid-cols-2 lg:grid-cols-5">
                    <li class="relative"><span
                            class="relative z-10 inline-flex h-14 w-14 items-center justify-center rounded-full bg-black text-sm font-bold text-white">01</span>
                        <h3 class="mt-7 text-base font-bold">Site assessment</h3>
                        <p class="mt-3 text-sm leading-6 text-muted">We visit your property and identify the risks, entry
                            points and hours that matter.</p>
                    </li>
                    <li class="relative"><span
                            class="relative z-10 inline-flex h-14 w-14 items-center justify-center rounded-full bg-black text-sm font-bold text-white">02</span>
                        <h3 class="mt-7 text-base font-bold">Deployment plan</h3>
                        <p class="mt-3 text-sm leading-6 text-muted">You receive a clear proposal: officer numbers, posts,
                            shifts and reporting.</p>
                    </li>
                    <li class="relative"><span
                            class="relative z-10 inline-flex h-14 w-14 items-center justify-center rounded-full bg-black text-sm font-bold text-white">03</span>
                        <h3 class="mt-7 text-base font-bold">Selection &amp; briefing</h3>
                        <p class="mt-3 text-sm leading-6 text-muted">Officers are briefed on your site, your guests and
                            your standards before day one.</p>
                    </li>
                    <li class="relative"><span
                            class="relative z-10 inline-flex h-14 w-14 items-center justify-center rounded-full bg-black text-sm font-bold text-white">04</span>
                        <h3 class="mt-7 text-base font-bold">Supervision</h3>
                        <p class="mt-3 text-sm leading-6 text-muted">Experienced supervisors check standards on site and
                            keep you informed.</p>
                    </li>
                    <li class="relative"><span
                            class="relative z-10 inline-flex h-14 w-14 items-center justify-center rounded-full bg-black text-sm font-bold text-white">05</span>
                        <h3 class="mt-7 text-base font-bold">Regular review</h3>
                        <p class="mt-3 text-sm leading-6 text-muted">We review performance with you and adapt the plan as
                            your needs change.</p>
                    </li>
                </ol>
            </div>
        </section>
        <section class="section container">
            <p class="eyebrow"><span></span>WHY GAGE SECURITY</p>
            <h2>Standards you can see in every officer.</h2>
            <div class="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <article><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m2 8 10-5 10 5-10 5-10-5Zm4 3v6c4 4 8 4 12 0v-6m4-3v9" />
                        </svg></span>
                    <h3 class="text-lg font-bold leading-6">Trained through our own institute</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Officers train with GAGE Training Institute, home of the
                        MQA-approved Certificate I in Security Officer Training.</p>
                </article>
                <article><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m12 2 8 5v9l-8 6-8-6V7Z m-4 10 3 3 5-6" />
                        </svg></span>
                    <h3 class="text-lg font-bold leading-6">ISO 9001:2015 quality</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Our quality management system is certified to ISO
                        9001:2015.</p>
                </article>
                <article><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 6v6l4 2" />
                        </svg></span>
                    <h3 class="text-lg font-bold leading-6">Reliable round-the-clock</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Protection and supervision that don’t stop when the
                        working day does.</p>
                </article>
                <article><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                            width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="8" r="5" />
                            <path d="m8 12-1 10 5-3 5 3-1-10" />
                        </svg></span>
                    <h3 class="text-lg font-bold leading-6">Trusted at the top</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Relied on by leading resorts, banks and diplomatic
                        missions — and three-time GOLD100 awardee.</p>
                </article>
            </div>
            <div class="mt-[120px]">
                <p class="eyebrow"><span></span>FAQ</p>
                <h2>Questions we’re often asked.</h2>
                <div class="physical-faq mt-10 border-t border-[#c9cdd3]">
                    <details class="border-b border-[#c9cdd3] py-6" open>
                        <summary
                            class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                            Are your officers trained and certified?<span
                                class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                                aria-hidden="true"></span></summary>
                        <p class="mt-5 pr-10 text-sm leading-7 text-muted">Yes. Our officers are trained through GAGE
                            Training Institute, whose Certificate I in Security Officer Training is approved by the Maldives
                            Qualifications Authority. The course covers access control, patrol techniques, observation,
                            report writing, basic fire training and first aid.</p>
                    </details>
                    <details class="border-b border-[#c9cdd3] py-6">
                        <summary
                            class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                            Can you provide officers at resorts outside Malé?<span
                                class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                                aria-hidden="true"></span></summary>
                        <p class="mt-5 pr-10 text-sm leading-7 text-muted">Yes. We deploy officers to resorts and
                            properties across the Maldives.</p>
                    </details>
                    <details class="border-b border-[#c9cdd3] py-6">
                        <summary
                            class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                            How quickly can you start?<span
                                class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                                aria-hidden="true"></span></summary>
                        <p class="mt-5 pr-10 text-sm leading-7 text-muted">Contact our security team to confirm the
                            deployment timeline for your property.</p>
                    </details>
                    <details class="border-b border-[#c9cdd3] py-6">
                        <summary
                            class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                            Can officers work alongside our existing CCTV or control room?<span
                                class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                                aria-hidden="true"></span></summary>
                        <p class="mt-5 pr-10 text-sm leading-7 text-muted">Yes. Officers can monitor your CCTV and work
                            with your control room procedures. If you need new systems, our Security System service can
                            design them for you.</p>
                    </details>
                    <details class="border-b border-[#c9cdd3] py-6">
                        <summary
                            class="flex cursor-pointer list-none items-center justify-between gap-6 text-base font-bold">
                            What reports will we receive?<span
                                class="faq-toggle flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-[#dfe2e7] text-xl"
                                aria-hidden="true"></span></summary>
                        <p class="mt-5 pr-10 text-sm leading-7 text-muted">Daily occurrence logs and incident reports, with
                            regular performance reviews with your management team.</p>
                    </details>
                </div>
            </div>
            <div class="mt-[120px]">
                <p class="eyebrow"><span></span>RELATED SERVICES</p>
                <h2>You may also need.</h2>
                <div class="mt-12 grid gap-6 md:grid-cols-3">
                    <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                                width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m2 8 10-5 10 5-10 5-10-5Zm4 3v6c4 4 8 4 12 0v-6m4-3v9" />
                            </svg></span>
                        <h3 class="text-xl font-bold">Patrol Service</h3>
                        <p class="mt-3 text-sm leading-6 text-muted">Mobile patrols that deter, detect and report — across
                            one site or many.</p><a href="./GAGE-Security.html#services"
                            class="mt-auto inline-flex items-center gap-2 pt-6 text-sm font-bold">View service<svg
                                width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </article>
                    <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                                width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m12 2 8 5v9l-8 6-8-6V7Z m-4 10 3 3 5-6" />
                            </svg></span>
                        <h3 class="text-xl font-bold">Event Security</h3>
                        <p class="mt-3 text-sm leading-6 text-muted">Crowd management, access control and on-site teams for
                            events of every size.</p><a href="./GAGE-Security.html#services"
                            class="mt-auto inline-flex items-center gap-2 pt-6 text-sm font-bold">View service<svg
                                width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </article>
                    <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span
                            class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                                width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="12" r="9" />
                                <path d="M12 6v6l4 2" />
                            </svg></span>
                        <h3 class="text-xl font-bold">Security System</h3>
                        <p class="mt-3 text-sm leading-6 text-muted">Integrated CCTV, access control and alarm systems
                            designed around your site.</p><a href="./GAGE-Security.html#services"
                            class="mt-auto inline-flex items-center gap-2 pt-6 text-sm font-bold">View service<svg
                                width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </article>
                </div>
            </div>
            <div
                class="mt-[120px] flex flex-col justify-between gap-9 rounded-[24px] bg-black px-9 py-16 text-white lg:flex-row lg:items-center lg:px-16">
                <div>
                    <h2 class="!mt-0">Secure your property with<br class="hidden lg:block"> GAGE.</h2>
                    <p class="mt-5 max-w-[740px] text-base leading-7 text-white/70">Tell us about your site. We’ll assess
                        your security needs and recommend the right<br class="hidden xl:block"> deployment.</p>
                </div>
                <div class="flex flex-col gap-3 lg:min-w-[320px]"><a href="./conact.html#enquiry"
                        class="button button-light">Request a security assessment<svg width="17" height="17"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a><a href="tel:+9603304055" class="button button-outline">Call +960 330 4055<svg
                            width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a></div>
            </div>
        </section>
@endsection
