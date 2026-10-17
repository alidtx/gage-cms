@extends('frontend.layouts.app')
@section('content')
@include('frontend.components.hero', ['hero' => [
    'variant' => 'split',
    'section_class' => 'bg-black text-white ZoomOutAnimation',
    'container_class' => 'container pb-20 pt-10',
    'grid_class' => 'grid items-center gap-14 lg:grid-cols-[1.2fr_1fr] lg:gap-24',
    'heading_class' => 'mt-7 text-[38px] font-bold leading-[1.1] tracking-[-1px] sm:text-[56px]',
    'heading' => [['text' => 'The Maldives’ leading', 'break_class' => 'hidden lg:block'], ['text' => 'client protection', 'break_class' => 'hidden lg:block'], ['text' => 'service provider.']],
    'description' => 'Founded in 2010 by former Commissioner of Police Abdulla Riyaz, GAGE delivers complete safety and security solutions — trusted by top resorts, banks and diplomatic missions nationwide.',
    'description_class' => 'mt-6 max-w-[680px] text-lg leading-[1.7] text-[#b9bec4]',
    'eyebrow' => 'ABOUT GAGE',
    'eyebrow_class' => 'eyebrow',
    'image' => ['src' => 'assets/about-0.jpg', 'width' => 722, 'height' => 1130, 'alt' => 'A protective GAGE shield over a Maldives island resort', 'class' => 'aspect-[1.45] w-full rounded-[16px] object-cover object-[50%_42%]'], 'breadcrumb' => ['title' => 'About', 'class' => 'mb-10 flex gap-3 text-xs text-[#b9bec4]']]])

        <section class="section container grid items-start gap-14 lg:grid-cols-2 lg:gap-24">
            <div>
                <p class="eyebrow"><span></span>OUR STORY</p>
                <h2>Built on a<br> client-protective<br> philosophy.</h2>
                <div class="mt-6 space-y-6 text-base leading-[1.8] text-muted">
                    <p>GAGE began on 21 July 2010 with a clear purpose: to offer a client protective service where the
                        client’s protection is always the top priority. From the start, we set out to bring
                        professional, disciplined standards to private security in the Maldives.</p>
                    <p>As clients asked for more, we grew with them. GAGE Fire Safety was established in 2015 to meet
                        the demand for specialised fire protection. GAGE Training Institute followed, building the
                        skills our industry needs. GAGE Store made trusted products easier to buy, and in 2026 GAGE
                        Technology joined the group to deliver integrated IT, networking and security systems.</p>
                    <p>Today, five specialist companies work as one — protecting people, property and assets across the
                        Maldives.</p>
                </div>
            </div><img width="842" height="1521" decoding="async" src="{{ asset('assets/about-1.jpg') }}"
                alt="GAGE team completing practical safety training on a resort jetty"
                class="ZoomOutAnimation about-story-image w-full rounded-[16px] object-cover object-[50%_48%]" loading="lazy">
        </section>
        <section class="bg-black text-white">
            <div class="section container">
                <p class="eyebrow"><span></span>MILESTONES</p>
                <h2>Sixteen years of protecting the Maldives.</h2>
                <ol class="mt-16 grid gap-10 sm:grid-cols-2 lg:grid-cols-5 lg:gap-0">
                    <li class="milestone relative border-t border-white/40 pr-6 pt-8"><span
                            class="absolute -top-[7px] left-0 h-3 w-3 rounded-full bg-white"></span>
                        <p class="text-[38px] font-bold">2010</p>
                        <h3 class="mt-3 text-lg font-bold">GAGE founded</h3>
                        <p class="mt-3 text-sm leading-6 text-[#9aa0a7]">Incorporated on 21 July 2010 by former
                            Commissioner of Police Abdulla Riyaz.</p>
                    </li>
                    <li class="milestone relative border-t border-white/40 pr-6 pt-8"><span
                            class="absolute -top-[7px] left-0 h-3 w-3 rounded-full bg-white"></span>
                        <p class="text-[38px] font-bold">2015</p>
                        <h3 class="mt-3 text-lg font-bold">GAGE Fire Safety</h3>
                        <p class="mt-3 text-sm leading-6 text-[#9aa0a7]">Established to provide complete fire safety
                            equipment, services, training and servicing.</p>
                    </li>
                    <li class="milestone relative border-t border-white/40 pr-6 pt-8"><span
                            class="absolute -top-[7px] left-0 h-3 w-3 rounded-full bg-white"></span>
                        <p class="text-[38px] font-bold">2021</p>
                        <h3 class="mt-3 text-lg font-bold">First GOLD100 award</h3>
                        <p class="mt-3 text-sm leading-6 text-[#9aa0a7]">Recognised with the Maldives’ most prestigious
                            business award — the first of three consecutive wins.</p>
                    </li>
                    <li class="milestone relative border-t border-white/40 pr-6 pt-8"><span
                            class="absolute -top-[7px] left-0 h-3 w-3 rounded-full bg-white"></span>
                        <p class="text-[38px] font-bold">2025</p>
                        <h3 class="mt-3 text-lg font-bold">15 years, new identities</h3>
                        <p class="mt-3 text-sm leading-6 text-[#9aa0a7]">Our four original companies launch their
                            rebranded identities.</p>
                    </li>
                    <li class="milestone relative border-t border-white/40 pr-6 pt-8"><span
                            class="absolute -top-[7px] left-0 h-3 w-3 rounded-full bg-white"></span>
                        <p class="text-[38px] font-bold">2026</p>
                        <h3 class="mt-3 text-lg font-bold">GAGE Technology</h3>
                        <p class="mt-3 text-sm leading-6 text-[#9aa0a7]">A fifth company joins the group on our 16th
                            anniversary.</p>
                    </li>
                </ol>
            </div>
        </section>
        <section class="section container">
            <p class="eyebrow"><span></span>WHAT DRIVES US</p>
            <h2>Vision, mission and value.</h2>
            <div class="mt-12 grid gap-6 md:grid-cols-3">
                <article class="rounded-[16px] border border-[#dfe2e7] p-8"><span class="icon-box"><svg aria-hidden="true" focusable="false" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                            aria-hidden="true">
                            <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg></span>
                    <h3 class="mt-7 text-xl font-bold">Vision</h3>
                    <p class="mt-3 text-base leading-7 text-muted">To be the most professional leader of the client
                        protective service industry, protecting people, property and assets.</p>
                </article>
                <article class="rounded-[16px] border border-[#dfe2e7] p-8"><span class="icon-box"><svg aria-hidden="true" focusable="false" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                            aria-hidden="true">
                            <circle cx="12" cy="12" r="9" />
                            <circle cx="12" cy="12" r="5" />
                            <circle cx="12" cy="12" r="1" />
                        </svg></span>
                    <h3 class="mt-7 text-xl font-bold">Mission</h3>
                    <p class="mt-3 text-base leading-7 text-muted">To provide quality security services, to attract and
                        retain professional talent, and to be the leader in the client protective services industry.</p>
                </article>
                <article class="rounded-[16px] border border-[#dfe2e7] p-8"><span class="icon-box"><svg aria-hidden="true" focusable="false" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                            aria-hidden="true">
                            <path d="M20 5a5 5 0 0 0-8 2 5 5 0 0 0-8-2c-6 6 8 15 8 15S26 11 20 5Z" />
                        </svg></span>
                    <h3 class="mt-7 text-xl font-bold">Value</h3>
                    <p class="mt-3 text-base leading-7 text-muted">The ethics of our business are quality of advice,
                        quality of service and quality of our people.</p>
                </article>
            </div>
        </section>
        <section id="about" class="bg-[#f4f5f7] ZoomOutAnimation">
            <div class="container section">
                <p class="eyebrow">
                    <span>
                    </span>WHY CHOOSE US
                </p>
                <h2>Six reasons clients stay with GAGE.</h2>
                <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <article class="rounded-[16px] border border-[#ebedf0] bg-white p-8 ZoomOutAnimation">
                        <span class="icon-box">
                            <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-users">
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
                            <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-handshake">
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
                            <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-award">
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
                            <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-clock">
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
                            <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-clipboard-check">
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
                            <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-badge-check">
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
        <section class="section container pb-0">
            <p class="eyebrow"><span></span>RECOGNITION</p>
            <h2>Awards and certifications.</h2>
            <div class="mt-12 grid gap-6 md:grid-cols-2">
                <article class="flex items-start gap-6 rounded-[16px] border border-[#dfe2e7] p-7"><img
                        src="{{ asset('assets/award-gold.png') }}" class="w-20 shrink-0 rounded-xl sm:w-28"
                        alt="GOLD100 — three consecutive years" loading="lazy">
                    <div>
                        <h3 class="text-lg font-bold">GOLD100 — three consecutive years</h3>
                        <p class="mt-3 text-base leading-7 text-muted">Recognised three times in a row with the
                            Maldives’ most prestigious business award.</p>
                    </div>
                </article>
                <article class="flex items-start gap-6 rounded-[16px] border border-[#dfe2e7] p-7"><img
                        src="{{ asset('assets/award-iso.png') }}" class="w-20 shrink-0 rounded-xl sm:w-28" alt="ISO 9001:2015"
                        loading="lazy">
                    <div>
                        <h3 class="text-lg font-bold">ISO 9001:2015</h3>
                        <p class="mt-3 text-base leading-7 text-muted">GAGE’s quality management system is certified to
                            ISO 9001:2015 — the only ISO-certified company in the Maldives’ security and safety
                            industry.</p>
                    </div>
                </article>
                <article class="flex items-start gap-6 rounded-[16px] border border-[#dfe2e7] p-7"><img
                        src="{{ asset('assets/award-defence.png') }}" class="w-20 shrink-0 rounded-xl sm:w-28"
                        alt="Authorised fire safety provider" loading="lazy">
                    <div>
                        <h3 class="text-lg font-bold">Authorised fire safety provider</h3>
                        <p class="mt-3 text-base leading-7 text-muted">Authorised by the Ministry of Defence and
                            National Security to deliver fire safety systems, with MNDF design and approval services.
                        </p>
                    </div>
                </article>
                <article class="flex items-start gap-6 rounded-[16px] border border-[#dfe2e7] p-7"><img
                        src="{{ asset('assets/award-mqa.png') }}" class="w-20 shrink-0 rounded-xl sm:w-28"
                        alt="MQA-approved training" loading="lazy">
                    <div>
                        <h3 class="text-lg font-bold">MQA-approved training</h3>
                        <p class="mt-3 text-base leading-7 text-muted">Our Certificate I in Security Officer Training is
                            approved by the Maldives Qualifications Authority.</p>
                    </div>
                </article>
            </div>
        </section>
        <section class="section container">
            <p class="eyebrow"><span></span>LEADERSHIP</p>
            <h2>Leadership you can reach.</h2>
            <p class="section-intro max-w-[930px]">Every contract we sign is owned at the top. Our leaders stay close to
                the work — from system design and approvals through to annual maintenance — and are directly contactable
                by the clients we serve.</p>
            <div class="mt-14 grid gap-x-6 gap-y-12 sm:grid-cols-2 lg:grid-cols-4">
                <article>
                    <div class="flex aspect-[.88] flex-col items-center justify-center rounded-t-[14px] border-b-[5px]"
                        style="background:color-mix(in srgb,#000000 7%,#f4f5f7);border-color:#000000"><svg aria-hidden="true" focusable="false" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="#b9bec4" stroke-width="1.5"
                            aria-hidden="true">
                            <rect x="4" y="3" width="16" height="18" rx="2" />
                            <circle cx="12" cy="9" r="3" />
                            <path d="M7 19c0-6 10-6 10 0" />
                        </svg><span class="mt-3 text-[10px] tracking-[2px] text-[#9aa0a7]">PORTRAIT</span></div>
                    <h3 class="mt-6 text-lg font-bold">Abdulla Riyaz</h3>
                    <p class="mt-1 text-sm leading-6 text-muted">Chairman &amp; Founder</p>
                </article>
                <article>
                    <div class="flex aspect-[.88] flex-col items-center justify-center rounded-t-[14px] border-b-[5px]"
                        style="background:color-mix(in srgb,#000000 7%,#f4f5f7);border-color:#000000"><svg aria-hidden="true" focusable="false" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="#b9bec4" stroke-width="1.5"
                            aria-hidden="true">
                            <rect x="4" y="3" width="16" height="18" rx="2" />
                            <circle cx="12" cy="9" r="3" />
                            <path d="M7 19c0-6 10-6 10 0" />
                        </svg><span class="mt-3 text-[10px] tracking-[2px] text-[#9aa0a7]">PORTRAIT</span></div>
                    <h3 class="mt-6 text-lg font-bold">Ameer Shaah</h3>
                    <p class="mt-1 text-sm leading-6 text-muted">Managing Director</p>
                </article>
                <article>
                    <div class="flex aspect-[.88] flex-col items-center justify-center rounded-t-[14px] border-b-[5px]"
                        style="background:color-mix(in srgb,#000000 7%,#f4f5f7);border-color:#000000"><svg aria-hidden="true" focusable="false" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="#b9bec4" stroke-width="1.5"
                            aria-hidden="true">
                            <rect x="4" y="3" width="16" height="18" rx="2" />
                            <circle cx="12" cy="9" r="3" />
                            <path d="M7 19c0-6 10-6 10 0" />
                        </svg><span class="mt-3 text-[10px] tracking-[2px] text-[#9aa0a7]">PORTRAIT</span></div>
                    <h3 class="mt-6 text-lg font-bold">Raya Riyaz</h3>
                    <p class="mt-1 text-sm leading-6 text-muted">Deputy Managing Director</p>
                </article>
                <article>
                    <div class="flex aspect-[.88] flex-col items-center justify-center rounded-t-[14px] border-b-[5px]"
                        style="background:color-mix(in srgb,#000000 7%,#f4f5f7);border-color:#000000"><svg aria-hidden="true" focusable="false" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="#b9bec4" stroke-width="1.5"
                            aria-hidden="true">
                            <rect x="4" y="3" width="16" height="18" rx="2" />
                            <circle cx="12" cy="9" r="3" />
                            <path d="M7 19c0-6 10-6 10 0" />
                        </svg><span class="mt-3 text-[10px] tracking-[2px] text-[#9aa0a7]">PORTRAIT</span></div>
                    <h3 class="mt-6 text-lg font-bold">Imran Ahmed Waheed</h3>
                    <p class="mt-1 text-sm leading-6 text-muted">Chief Operating Officer, GAGE Security</p>
                </article>
                <article>
                    <div class="flex aspect-[.88] flex-col items-center justify-center rounded-t-[14px] border-b-[5px]"
                        style="background:color-mix(in srgb,#c61026 7%,#f4f5f7);border-color:#c61026"><svg aria-hidden="true" focusable="false" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="#b9bec4" stroke-width="1.5"
                            aria-hidden="true">
                            <rect x="4" y="3" width="16" height="18" rx="2" />
                            <circle cx="12" cy="9" r="3" />
                            <path d="M7 19c0-6 10-6 10 0" />
                        </svg><span class="mt-3 text-[10px] tracking-[2px] text-[#9aa0a7]">PORTRAIT</span></div>
                    <h3 class="mt-6 text-lg font-bold">Umair Ahmed</h3>
                    <p class="mt-1 text-sm leading-6 text-muted">Chief Operating Officer, GAGE Fire Safety</p>
                </article>
                <article>
                    <div class="flex aspect-[.88] flex-col items-center justify-center rounded-t-[14px] border-b-[5px]"
                        style="background:color-mix(in srgb,#2430ce 7%,#f4f5f7);border-color:#2430ce"><svg aria-hidden="true" focusable="false" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="#b9bec4" stroke-width="1.5"
                            aria-hidden="true">
                            <rect x="4" y="3" width="16" height="18" rx="2" />
                            <circle cx="12" cy="9" r="3" />
                            <path d="M7 19c0-6 10-6 10 0" />
                        </svg><span class="mt-3 text-[10px] tracking-[2px] text-[#9aa0a7]">PORTRAIT</span></div>
                    <h3 class="mt-6 text-lg font-bold">Ahmed Nasir</h3>
                    <p class="mt-1 text-sm leading-6 text-muted">Head of GAGE Training Institute</p>
                </article>
                <article>
                    <div class="flex aspect-[.88] flex-col items-center justify-center rounded-t-[14px] border-b-[5px]"
                        style="background:color-mix(in srgb,#197379 7%,#f4f5f7);border-color:#197379"><svg aria-hidden="true" focusable="false" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="#b9bec4" stroke-width="1.5"
                            aria-hidden="true">
                            <rect x="4" y="3" width="16" height="18" rx="2" />
                            <circle cx="12" cy="9" r="3" />
                            <path d="M7 19c0-6 10-6 10 0" />
                        </svg><span class="mt-3 text-[10px] tracking-[2px] text-[#9aa0a7]">PORTRAIT</span></div>
                    <h3 class="mt-6 text-lg font-bold">Arif Thowfeek</h3>
                    <p class="mt-1 text-sm leading-6 text-muted">Director, GAGE Technology</p>
                </article>
            </div>
        </section>
        <section class="container pb-[120px]">
            <p class="eyebrow"><span></span>BRANDS WE WORK WITH</p>
            <h2>Trusted global brands, installed and<br class="hidden lg:block"> supported locally.</h2>
            <div class="mt-12 grid grid-cols-3 gap-5 sm:grid-cols-6">
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-13.png') }}" alt="AJAX" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-15.jpg') }}" alt="GST" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-14.png') }}" alt="Sunreach" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/brand-notifier.png') }}" alt="Notifier by Honeywell"
                        class="max-h-14 max-w-full object-contain" loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/brand-cofem.png') }}" alt="Cofem" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/brand-bosch.png') }}" alt="Bosch" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-12.png') }}" alt="WBOX Technologies"
                        class="max-h-14 max-w-full object-contain" loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-7.jpg') }}" alt="Aruba" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-6.jpg') }}" alt="Avigilon" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-5.png') }}" alt="Axis Communications"
                        class="max-h-14 max-w-full object-contain" loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-8.jpg') }}" alt="Cisco" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-11.png') }}" alt="CP PLUS" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-4.jpg') }}" alt="HI-FOCUS" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-3.png') }}" alt="Honeywell" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-2.png') }}" alt="IDIS" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-10.jpg') }}" alt="Imou" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-9.png') }}" alt="Intelbras" class="max-h-14 max-w-full object-contain"
                        loading="lazy"></div>
                <div class="flex h-20 items-center justify-center rounded-lg border border-[#dfe2e7] px-4"><img
                        src="{{ asset('assets/about-16.png') }}" alt="Palo Alto Networks"
                        class="max-h-14 max-w-full object-contain" loading="lazy"></div>
            </div>
        </section>
        <section class="container pb-[120px]">
            <p class="eyebrow"><span></span>OUR COMPANIES</p>
            <h2>Meet the GAGE companies.</h2>
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-5"><a href="{{ route('frontend.home') }}#security"
                    class="overflow-hidden rounded-[14px] text-white" style="background:#000"><img
                        src="{{ asset('assets/security1.png') }}" alt="GAGE Security"
                        class="aspect-[1.64] w-full object-cover"><span
                        class="flex items-center gap-2 px-6 pb-6 text-sm font-bold">Explore<svg aria-hidden="true" focusable="false" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></span></a>

                        <a href="{{ route('frontend.home') }}#fire"
                    class="overflow-hidden rounded-[14px] text-white" style="background:#c61026"><img
                        src="{{ asset('assets/fire1.png') }}" alt="GAGE Fire Safety"
                        class="aspect-[1.64] w-full object-cover"><span
                        class="flex items-center gap-2 px-6 pb-6 text-sm font-bold">Explore<svg aria-hidden="true" focusable="false" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></span></a><a href="{{ route('frontend.home') }}#institute"
                    class="overflow-hidden rounded-[14px] text-white" style="background:#2430ce"><img
                        src="{{ asset('assets/institute1.png') }}" alt="GAGE Training Institute"
                        class="aspect-[1.64] w-full object-cover"><span
                        class="flex items-center gap-2 px-6 pb-6 text-sm font-bold">Explore<svg aria-hidden="true" focusable="false" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></span></a><a href="{{ route('frontend.home') }}#technology"
                    class="overflow-hidden rounded-[14px] text-white" style="background:#197379"><img
                        src="{{ asset('assets/technology1.png') }}" alt="GAGE Technology"
                        class="aspect-[1.64] w-full object-cover"><span
                        class="flex items-center gap-2 px-6 pb-6 text-sm font-bold">Explore<svg aria-hidden="true" focusable="false" width="18" height="18"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></span></a><a href="https://shop.gage.com.mv"
                    class="overflow-hidden rounded-[14px] text-white" style="background:#442424">
                    <div class="flex aspect-[1.64] flex-col items-center justify-center"><img
                            src="{{ asset('assets/security1.png') }}" alt="GAGE Store"
                            class="h-28 w-36 object-cover mix-blend-screen"><span
                            class="text-xs tracking-[5px]">STORE</span></div><span
                        class="flex items-center gap-2 px-6 pb-6 text-sm font-bold">Visit site<svg aria-hidden="true" focusable="false" width="18"
                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></span>
                </a></div>
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
                    <a href="{{ route('contact.create') }}#enquiry" class="button button-light">Request a
                        quote<svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-arrow-right">
                            <path d="M5 12h14">
                            </path>
                            <path d="m12 5 7 7-7 7">
                            </path>
                        </svg>
                    </a>
                    <a class="button button-outline justify-between" href="tel:+9603304055">Call +960 330 4055<svg
                            xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-phone">
                            <path
                                d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </section>
@endsection
