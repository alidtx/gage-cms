@extends('frontend.layouts.app')
@section('content')
@include('frontend.components.hero')
    <section id="services" class="section container">
        <p class="eyebrow"><span></span>SERVICES</p>
        <h2>Nine ways we keep you protected.</h2>
        <p class="section-intro max-w-[960px]">From a single guard post to a full security operation, every service is
            planned around your site, your<br class="hidden lg:block"> people and your risks.</p>
        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span class="icon-box"><svg
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m12 3 8 4v5c0 5-8 9-8 9s-8-4-8-9V7l8-4Z" />
                        <path d="m8 12 3 3 5-6" />
                    </svg></span>
                <h3 class="mt-7 text-xl font-bold">Physical Security</h3>
                <p class="mt-3 flex-1 text-base leading-7 text-muted">Trained, uniformed officers protecting resorts,
                    offices, industrial sites and residences around the clock.</p><a
                    href="./Service-Detail-Security-Physical-Security.html"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold">View service<svg width="18"
                        height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a>
            </article>
            <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span class="icon-box"><svg
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="9" cy="8" r="3" />
                        <path d="M3 21v-3a6 6 0 0 1 12 0v3m1-16a3 3 0 0 1 0 6m3 10v-3a6 6 0 0 0-3-5" />
                    </svg></span>
                <h3 class="mt-7 text-xl font-bold">Event Security</h3>
                <p class="mt-3 flex-1 text-base leading-7 text-muted">Crowd management, access control and on-site teams for
                    events of every size.</p><a href="./conact.html#enquiry"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold">View service<svg width="18"
                        height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a>
            </article>
            <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span class="icon-box"><svg
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="9" cy="8" r="3" />
                        <path d="M3 21v-3a6 6 0 0 1 12 0v3m2-16 1 2 3 .5-2 2 .5 3-2.5-1.5-2.5 1.5.5-3-2-2 3-.5 1-2Z" />
                    </svg></span>
                <h3 class="mt-7 text-xl font-bold">VIP Security</h3>
                <p class="mt-3 flex-1 text-base leading-7 text-muted">Discreet close protection for dignitaries, executives
                    and high-profile guests.</p><a href="./conact.html#enquiry"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold">View service<svg
                        width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a>
            </article>
            <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span class="icon-box"><svg
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 5h11v13H3V5Zm11 5h4l3 4v4h-7" />
                        <circle cx="7" cy="19" r="2" />
                        <circle cx="18" cy="19" r="2" />
                    </svg></span>
                <h3 class="mt-7 text-xl font-bold">Cash In Transit</h3>
                <p class="mt-3 flex-1 text-base leading-7 text-muted">Secure transport of cash and valuables between your
                    premises and the bank.</p><a href="./conact.html#enquiry"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold">View service<svg
                        width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a>
            </article>
            <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span class="icon-box"><svg
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M5 20h14M7 20v-7a5 5 0 0 1 10 0v7M12 2v3M3 6l2 2m14 0 2-2M2 13h3m14 0h3" />
                        <path d="M12 11v4" />
                    </svg></span>
                <h3 class="mt-7 text-xl font-bold">Intruder Alarm Service</h3>
                <p class="mt-3 flex-1 text-base leading-7 text-muted">Intruder alarm systems for homes and businesses,
                    installed and serviced by our team.</p><a href="./conact.html#enquiry"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold">View service<svg
                        width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a>
            </article>
            <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span class="icon-box"><svg
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m3 13 2-6h12l4 6v6H3v-6Zm0 0h18" />
                        <circle cx="7" cy="18" r="1" />
                        <circle cx="17" cy="18" r="1" />
                    </svg></span>
                <h3 class="mt-7 text-xl font-bold">Patrol Service</h3>
                <p class="mt-3 flex-1 text-base leading-7 text-muted">Mobile patrols that deter, detect and report — across
                    one site or many.</p><a href="./conact.html#enquiry"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold">View service<svg
                        width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a>
            </article>
            <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span class="icon-box"><svg
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M12 3v14m-4-6h8m-12 4c0 8 16 8 16 0M4 15l-2 3m18-3 2 3" />
                        <circle cx="12" cy="5" r="2" />
                    </svg></span>
                <h3 class="mt-7 text-xl font-bold">Marine Security</h3>
                <p class="mt-3 flex-1 text-base leading-7 text-muted">Protection for vessels, jetties and marine operations
                    across the atolls.</p><a href="./conact.html#enquiry"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold">View service<svg
                        width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a>
            </article>
            <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span class="icon-box"><svg
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M3 17h18v4H3v-4Zm2 0v-3a7 7 0 0 1 14 0v3M10 7V4h4v3" />
                    </svg></span>
                <h3 class="mt-7 text-xl font-bold">Health, Safety & Environment</h3>
                <p class="mt-3 flex-1 text-base leading-7 text-muted">HSE support that keeps your workplace safe, compliant
                    and ready to respond.</p><a href="./conact.html#enquiry"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold">View service<svg
                        width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a>
            </article>
            <article class="flex flex-col rounded-[16px] border border-[#dfe2e7] p-8"><span class="icon-box"><svg
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="m3 6 13 3-3 8L2 12l1-6Zm11 7 6 2m-5 2v4m-4 0h8" />
                    </svg></span>
                <h3 class="mt-7 text-xl font-bold">Security System</h3>
                <p class="mt-3 flex-1 text-base leading-7 text-muted">Integrated CCTV, access control and alarm systems
                    designed around your site.</p><a href="./conact.html#enquiry"
                    class="mt-6 inline-flex items-center gap-2 self-start text-sm font-bold">View service<svg
                        width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a>
            </article>
        </div>
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
