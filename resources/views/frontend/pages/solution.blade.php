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
                    ['text' => 'Total safety and', 'break_class' => 'hidden lg:block'],
                    [
                        'text' => 'security for island',
                        'break_class' => 'hidden lg:block',
                    ],
                    ['text' => 'resorts.'],
                ],
                'description' =>
                    'Your guests expect to feel safe without ever noticing what keeps them safe. GAGE brings security, fire safety, training and technology together — one partner protecting your island, from the jetty to the back-of-house.',
                'description_class' => 'mt-6 max-w-[680px] text-lg leading-[1.7] text-[#b9bec4]',
                'eyebrow' => 'SOLUTIONS · RESORTS & HOTELS',
                'eyebrow_class' => 'eyebrow',
                'image' => [
                    'src' => 'assets/about-0.jpg',
                    'width' => 722,
                    'height' => 1130,
                    'alt' => 'A protective GAGE shield over a Maldives island resort',
                    'class' => 'aspect-[1.45] w-full rounded-[16px] object-cover object-[50%_42%]',
                ],
                'breadcrumb' => ['title' => 'Solutions', 'class' => 'mb-10 flex gap-3 text-xs text-[#b9bec4]'],
            ],
            $heroContent),
    ])
    <section class="section container">
        <p class="eyebrow"><span></span>WHY RESORTS ARE DIFFERENT</p>
        <h2>Island resorts face unique risks.</h2>
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                    class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                        width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                        stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m3 5 6-3 6 3 6-3v17l-6 3-6-3-6 3V5Zm6-3v17m6-14v17" />
                    </svg></span>
                <h3 class="text-lg font-bold">Remote by nature</h3>
                <p class="mt-3 text-base leading-7 text-muted">Outside help can be hours away. Your team and systems
                    must be ready to respond on their own.</p>
            </article>
            <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                    class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                        width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m12 2 2 7 7 3-7 2-2 8-2-8-8-2 8-3 2-7Zm7 0v5m-2-2h5" />
                    </svg></span>
                <h3 class="text-lg font-bold">Guest experience first</h3>
                <p class="mt-3 text-base leading-7 text-muted">Protection has to be visible enough to reassure — and
                    discreet enough not to intrude.</p>
            </article>
            <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                    class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                        width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <rect x="5" y="4" width="14" height="18" rx="2" />
                        <path d="M9 2h6v5H9Zm0 10h6m-6 4h6" />
                    </svg></span>
                <h3 class="text-lg font-bold">Compliance and audits</h3>
                <p class="mt-3 text-base leading-7 text-muted">Fire safety approvals, maintenance records and staff
                    training must always be up to date.</p>
            </article>
            <article class="rounded-[16px] border border-[#dfe2e7] p-7"><span
                    class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#e9ebef]"><svg
                        width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M7 5a5 5 0 0 1 10 0 4 4 0 0 1 3 7l-2 2v7H6v-7l-2-2a4 4 0 0 1 3-7Zm-1 12h12" />
                    </svg></span>
                <h3 class="text-lg font-bold">Busy back-of-house</h3>
                <p class="mt-3 text-base leading-7 text-muted">Kitchens, LPG, fuel farms and power houses bring fire
                    risks that never switch off.</p>
            </article>
        </div>
    </section>
    <section class="section bg-[#f4f5f7]">
        <div class="container">
            <p class="eyebrow"><span></span>WHAT WE PROVIDE</p>
            <h2>Four GAGE companies. One resort<br class="hidden lg:block"> partner.</h2>
            <div class="mt-12 grid gap-6 md:grid-cols-2">
                <article class="flex flex-col overflow-hidden rounded-[16px] border border-[#dfe2e7] bg-white">
                    <div class="flex h-[185px] items-center justify-center" style="background:#000000"><img
                            src="{{ asset('assets/security-hero-logo.png') }}" alt="GAGE Security"
                            class="h-[125px] w-[140px] object-contain"></div>
                    <div class="flex flex-1 flex-col p-8">
                        <ul class="space-y-3 text-sm leading-6 text-muted">
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#000000;background:#00000015" aria-hidden="true">✓</span>Physical
                                security and patrols</li>
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#000000;background:#00000015" aria-hidden="true">✓</span>VIP
                                security for high-profile guests</li>
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#000000;background:#00000015" aria-hidden="true">✓</span>Marine
                                security for jetties and vessels</li>
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#000000;background:#00000015" aria-hidden="true">✓</span>Event
                                security</li>
                        </ul><a href="./GAGE-Security.html"
                            class="mt-auto inline-flex items-center gap-2 pt-8 text-sm font-extrabold"
                            style="color:#000000">Explore GAGE Security<svg width="17" height="17"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </div>
                </article>
                <article class="flex flex-col overflow-hidden rounded-[16px] border border-[#dfe2e7] bg-white">
                    <div class="flex h-[185px] items-center justify-center" style="background:#c61026"><img
                            src="{{ asset('assets/fire-hero-logo.png') }}" alt="GAGE Fire Safety"
                            class="h-[125px] w-[140px] object-contain"></div>
                    <div class="flex flex-1 flex-col p-8">
                        <ul class="space-y-3 text-sm leading-6 text-muted">
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#c61026;background:#c6102615" aria-hidden="true">✓</span>System
                                design and MNDF approval</li>
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#c61026;background:#c6102615" aria-hidden="true">✓</span>Kitchen
                                hood cleaning and LPG maintenance</li>
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#c61026;background:#c6102615" aria-hidden="true">✓</span>On-site
                                fire extinguisher servicing</li>
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#c61026;background:#c6102615" aria-hidden="true">✓</span>Annual
                                maintenance contracts (AMC)</li>
                        </ul><a href="./GAGE-Fire-Safety.html"
                            class="mt-auto inline-flex items-center gap-2 pt-8 text-sm font-extrabold"
                            style="color:#c61026">Explore GAGE Fire Safety<svg width="17" height="17"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </div>
                </article>
                <article class="flex flex-col overflow-hidden rounded-[16px] border border-[#dfe2e7] bg-white">
                    <div class="flex h-[185px] items-center justify-center" style="background:#2430ce"><img
                            src="{{ asset('assets/training-hero-logo.png') }}" alt="GAGE Training Institute"
                            class="h-[125px] w-[140px] object-contain"></div>
                    <div class="flex flex-1 flex-col p-8">
                        <ul class="space-y-3 text-sm leading-6 text-muted">
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#2430ce;background:#2430ce15" aria-hidden="true">✓</span>On-property
                                mobile classes</li>
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#2430ce;background:#2430ce15" aria-hidden="true">✓</span>Lifeguard
                                and first aid training</li>
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#2430ce;background:#2430ce15" aria-hidden="true">✓</span>Industrial
                                Fire Brigade Course — 7 days at your resort, 3 at the MNDF facility</li>
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#2430ce;background:#2430ce15" aria-hidden="true">✓</span>Hospitality
                                vocational training with a job link</li>
                        </ul><a href="./GAGE-Training-Institute.html"
                            class="mt-auto inline-flex items-center gap-2 pt-8 text-sm font-extrabold"
                            style="color:#2430ce">Explore the Institute<svg width="17" height="17"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </div>
                </article>
                <article class="flex flex-col overflow-hidden rounded-[16px] border border-[#dfe2e7] bg-white">
                    <div class="flex h-[185px] items-center justify-center" style="background:#197379"><img
                            src="{{ asset('assets/technology-hero-logo.png') }}" alt="GAGE Technology"
                            class="h-[125px] w-[140px] object-contain"></div>
                    <div class="flex flex-1 flex-col p-8">
                        <ul class="space-y-3 text-sm leading-6 text-muted">
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#197379;background:#19737915" aria-hidden="true">✓</span>Guest and
                                back-of-house networks</li>
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#197379;background:#19737915" aria-hidden="true">✓</span>CCTV and
                                access control</li>
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#197379;background:#19737915" aria-hidden="true">✓</span>Communications
                                and radio systems</li>
                            <li class="flex gap-3"><span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-xs font-extrabold"
                                    style="color:#197379;background:#19737915" aria-hidden="true">✓</span>Preventive
                                maintenance and AMC</li>
                        </ul><a href="./GAGE-Technology.html"
                            class="mt-auto inline-flex items-center gap-2 pt-8 text-sm font-extrabold"
                            style="color:#197379">Explore GAGE Technology<svg width="17" height="17"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </div>
                </article>
            </div>
        </div>
    </section>
    <section class="section container">
        <div class="grid gap-10 rounded-[24px] bg-black p-10 text-white lg:grid-cols-[.75fr_1.7fr] lg:p-16">
            <div class="self-center">
                <p class="text-[88px] font-extrabold leading-none tracking-[-3px]">32</p>
                <p class="mt-3 text-xl font-bold leading-7">resorts with fire safety systems<br> installed by GAGE
                </p>
            </div>
            <div>
                <p class="text-xs font-bold tracking-[1.8px] text-white/60">INCLUDING</p>
                <ul class="mt-6 grid gap-x-8 gap-y-5 text-sm font-bold sm:grid-cols-3">
                    <li>Soneva Jani</li>
                    <li>Soneva Fushi</li>
                    <li>Velaa Private Island</li>
                    <li>W Maldives</li>
                    <li>Conrad Maldives Rangali Island</li>
                    <li>Waldorf Astoria Maldives</li>
                    <li>One&amp;Only Reethi Rah</li>
                    <li>Six Senses Maldives</li>
                    <li>JW Marriott Maldives</li>
                </ul><a href="{{ route('frontend.gage-project-client') }}"
                    class="mt-10 inline-flex items-center gap-2 text-sm font-bold">See all projects on the map<svg
                        width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a>
            </div>
        </div>
        <div class="mt-[120px]">
            <p class="eyebrow"><span></span>HOW WE WORK WITH RESORTS</p>
            <h2>From assessment to annual care.</h2>
            <ol class="physical-process mt-16 grid gap-10 sm:grid-cols-2 lg:grid-cols-5">
                <li class="relative"><span
                        class="relative z-10 inline-flex h-14 w-14 items-center justify-center rounded-full bg-black text-sm font-bold text-white">01</span>
                    <h3 class="mt-7 text-base font-bold">Site assessment</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">We review your island’s security, fire safety,
                        training and technology needs.</p>
                </li>
                <li class="relative"><span
                        class="relative z-10 inline-flex h-14 w-14 items-center justify-center rounded-full bg-black text-sm font-bold text-white">02</span>
                    <h3 class="mt-7 text-base font-bold">One proposal</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">A single plan covering every GAGE company you need.
                    </p>
                </li>
                <li class="relative"><span
                        class="relative z-10 inline-flex h-14 w-14 items-center justify-center rounded-full bg-black text-sm font-bold text-white">03</span>
                    <h3 class="mt-7 text-base font-bold">Install &amp; deploy</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Systems installed and teams deployed with minimal
                        guest disruption.</p>
                </li>
                <li class="relative"><span
                        class="relative z-10 inline-flex h-14 w-14 items-center justify-center rounded-full bg-black text-sm font-bold text-white">04</span>
                    <h3 class="mt-7 text-base font-bold">Train &amp; hand over</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Your staff are trained on site to respond with
                        confidence.</p>
                </li>
                <li class="relative"><span
                        class="relative z-10 inline-flex h-14 w-14 items-center justify-center rounded-full bg-black text-sm font-bold text-white">05</span>
                    <h3 class="mt-7 text-base font-bold">Annual care</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Maintenance contracts keep everything compliant
                        year after year.</p>
                </li>
            </ol>
        </div>
        <div class="mt-[120px]">
            <h2>Trusted by resorts across the atolls.</h2>
            <div class="mt-10 grid grid-cols-2 gap-6 sm:grid-cols-3 lg:grid-cols-6">
                <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] px-5 py-3">
                    <img src="{{ asset('assets/projects-page-3.png') }}" alt="Resort client logo"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </div>
                <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] px-5 py-3">
                    <img src="{{ asset('assets/projects-page-74.png') }}" alt="Resort client logo"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </div>
                <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] px-5 py-3">
                    <img src="{{ asset('assets/projects-page-2.jpg') }}" alt="Resort client logo"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </div>
                <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] px-5 py-3">
                    <img src="{{ asset('assets/projects-page-78.png') }}" alt="Resort client logo"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </div>
                <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] px-5 py-3">
                    <img src="{{ asset('assets/projects-page-4.jpg') }}" alt="Resort client logo"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </div>
                <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] px-5 py-3">
                    <img src="{{ asset('assets/projects-page-6.jpg') }}" alt="Resort client logo"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </div>
                <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] px-5 py-3">
                    <img src="{{ asset('assets/projects-page-7.png') }}" alt="Resort client logo"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </div>
                <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] px-5 py-3">
                    <img src="{{ asset('assets/projects-page-79.png') }}" alt="Resort client logo"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </div>
                <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] px-5 py-3">
                    <img src="{{ asset('assets/projects-page-67.jpg') }}" alt="Resort client logo"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </div>
                <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] px-5 py-3">
                    <img src="{{ asset('assets/projects-page-5.jpg') }}" alt="Resort client logo"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </div>
                <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] px-5 py-3">
                    <img src="{{ asset('assets/projects-page-10.png') }}" alt="Resort client logo"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </div>
                <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] px-5 py-3">
                    <img src="{{ asset('assets/projects-page-8.jpg') }}" alt="Resort client logo"
                        class="max-h-full max-w-full object-contain" loading="lazy">
                </div>
            </div>
        </div>
        <div
            class="mt-[120px] flex flex-col justify-between gap-9 rounded-[24px] bg-black px-9 py-16 text-white lg:flex-row lg:items-center lg:px-16">
            <div>
                <h2 class="!mt-0">Protect your island with one<br class="hidden lg:block"> partner.</h2>
                <p class="mt-5 max-w-[740px] text-base leading-7 text-white/70">Tell us what you need to protect.
                    Our team will recommend the right mix of security,<br class="hidden xl:block"> fire safety,
                    training and technology — and give you a clear proposal.</p>
            </div>
            <div class="flex flex-col gap-3 lg:min-w-[320px]"><a href="./conact.html#enquiry"
                    class="button button-light">Request a resort assessment<svg width="17" height="17"
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
