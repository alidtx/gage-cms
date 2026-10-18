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
                ['text' => 'Building capable', 'break_class' => 'hidden xl:block'],
                ['text' => 'professionals, since', 'break_class' => 'hidden xl:block'],
                ['text' => 'day one.'],
            ],
            'description' =>
                'We develop capable professionals in security, safety and emergency response through accredited, hands-on programmes built for real-world performance.',
            'description_class' => 'mt-6 max-w-[620px] text-lg leading-[1.7] text-white/80',
            'logo' => ['src' => 'assets/training-hero-logo.png', 'alt' => 'GAGE Institute'],
            'image' => [
                'src' => 'assets/training-page-0.jpg',
                'width' => 734,
                'height' => 982,
                'alt' => 'Students practising emergency response and CPR with a trainer',
                'class' => 'aspect-[.9] w-full rounded-[16px] object-cover',
            ],
            'buttons' => [
                [
                    'label' => 'Browse programmes',
                    'url' => '#programmes',
                    'class' => 'button button-light !text-[#2430ce]',
                    'arrow' => 'yes',
                ],
                [
                    'label' => 'Enquire about training',
                    'url' => '/contact#enquiry',
                    'class' => 'button button-outline',
                    'arrow' => 'yes',
                ],
            ],
            'breadcrumb' => [
                'title' => 'GAGE Training Institute',
                'class' => 'mb-10 flex flex-wrap gap-2 text-xs leading-6 text-white/70',
                'parents' => [['label' => 'Our Companies', 'url' => route('frontend.home') . '#companies']],
            ],
        ], $heroContent),
    ])
    {{-- <section class="section container">
        <div class="grid items-start gap-12 lg:grid-cols-2 lg:gap-24">
            <div>
                <p class="eyebrow text-[#2430ce]"><span></span>ABOUT THE INSTITUTE</p>
                <h2>For people entrusted<br> with critical<br> responsibilities.</h2>
                <div class="mt-6 space-y-5 text-base leading-[1.8] text-muted">
                    <p>Our training is designed for those entrusted with critical responsibilities, where
                        preparedness, precision and sound judgement are non-negotiable.</p>
                    <p>Led by experienced practitioners, our programmes combine practical instruction with strategic
                        insight across security operations, lifesaving response, leadership, investigations,
                        cybersecurity and risk management. Whether you are advancing your career or preparing to
                        lead, GAGE equips you with the competence and confidence to perform decisively when it
                        matters most.</p>
                </div>
            </div>
            <img src="{{ asset('assets/training-page-2.jpg') }}"
                alt="Hospitality professional welcoming a guest at a resort reception"
                width="613" height="342" loading="lazy" decoding="async"
                class="w-full rounded-[16px] object-cover">
        </div>
        <div class="mt-[120px] grid items-start gap-12 lg:grid-cols-2 lg:gap-24"><img
                src="./public/assets/training-page-1.jpg"
                alt="Hospitality students learning practical customer service at a resort"
                class="aspect-[1.3] w-full rounded-[16px] object-cover" loading="lazy">
            <div>
                <p class="eyebrow text-[#2430ce]"><span></span>OUR APPROACH</p>
                <h2>Practical, job-based and<br> linked to real careers.</h2>
                <div class="mt-6 space-y-5 text-base leading-[1.8] text-muted">
                    <p>Our training is highly skill-based, tailored to build people for vocations and professions.
                        Assessments and classes are practical and job-based, following a step-by-step approach.</p>
                    <p>We form strategic partnerships with companies so candidates who finish our hospitality
                        courses have a guaranteed link to jobs in the Maldives. Once they enter the job market, our
                        work doesn’t stop — we build them towards a degree or master’s in their expertise while on
                        the job.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section bg-[#f0f1fc]">
        <div class="container">
            <p class="eyebrow text-[#2430ce]"><span></span>DELIVERY MODELS</p>
            <h2>Training that comes to you.</h2>
            <div class="mt-10 grid gap-6 md:grid-cols-3">
                <article class="rounded-[16px] border border-[#e5e7eb] bg-white p-8"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#dfe1fa] text-[#2430ce]"><svg
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" aria-hidden="true">
                            <path d="M12 3 4 6v6c0 5 8 9 8 9s8-4 8-9V6Z" />
                            <path d="m8 12 3 3 5-6" />
                        </svg></span>
                    <h3 class="text-lg font-bold">On-site mobile classes</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Classes conducted on site — for example, at resorts
                        for hospitality students and staff.</p>
                </article>
                <article class="rounded-[16px] border border-[#e5e7eb] bg-white p-8"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#dfe1fa] text-[#2430ce]"><svg
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" aria-hidden="true">
                            <circle cx="12" cy="12" r="9" />
                            <path d="M12 7v5l3 2M5 3 2 6m17-3 3 3" />
                        </svg></span>
                    <h3 class="text-lg font-bold">Weekend &amp; evening classes</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">For students in Malé and other islands who work
                        daytime jobs.</p>
                </article>
                <article class="rounded-[16px] border border-[#e5e7eb] bg-white p-8"><span
                        class="mb-5 inline-flex h-[52px] w-[52px] items-center justify-center rounded-xl bg-[#dfe1fa] text-[#2430ce]"><svg
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.6" aria-hidden="true">
                            <rect x="3" y="4" width="18" height="13" rx="2" />
                            <path d="M8 21h8m-4-4v4" />
                        </svg></span>
                    <h3 class="text-lg font-bold">Virtual classrooms</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">For learners out of reach or in more remote
                        locations.</p>
                </article>
            </div>
        </div>
    </section>
    <section class="section container">
        <p class="eyebrow text-[#2430ce]"><span></span>INDUSTRY FOCUS</p>
        <h2>Sectors we serve.</h2>
        <p class="section-intro max-w-[850px]">We specialise in identifying, training and placing talent in the
            hospitality industry — from front-line trades to leadership and management.</p>
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            <article class="overflow-hidden rounded-[16px] border border-[#dfe2e7]"><img
                    src="./public/assets/training-page-2.jpg" alt="Customer Service practical training"
                    class="aspect-[1.85] w-full object-cover" loading="lazy">
                <h3 class="p-6 text-lg font-bold">Customer Service</h3>
            </article>
            <article class="overflow-hidden rounded-[16px] border border-[#dfe2e7]"><img
                    src="./public/assets/training-page-3.jpg" alt="Food & Beverage practical training"
                    class="aspect-[1.85] w-full object-cover" loading="lazy">
                <h3 class="p-6 text-lg font-bold">Food &amp; Beverage</h3>
            </article>
            <article class="overflow-hidden rounded-[16px] border border-[#dfe2e7]"><img
                    src="./public/assets/training-page-4.jpg" alt="Housekeeping practical training"
                    class="aspect-[1.85] w-full object-cover" loading="lazy">
                <h3 class="p-6 text-lg font-bold">Housekeeping</h3>
            </article>
            <article class="overflow-hidden rounded-[16px] border border-[#dfe2e7]"><img
                    src="./public/assets/training-page-5.jpg" alt="Sales & Marketing practical training"
                    class="aspect-[1.85] w-full object-cover" loading="lazy">
                <h3 class="p-6 text-lg font-bold">Sales &amp; Marketing</h3>
            </article>
            <article class="overflow-hidden rounded-[16px] border border-[#dfe2e7]"><img
                    src="./public/assets/training-page-6.jpg" alt="Security practical training"
                    class="aspect-[1.85] w-full object-cover" loading="lazy">
                <h3 class="p-6 text-lg font-bold">Security</h3>
            </article>
            <article class="overflow-hidden rounded-[16px] border border-[#dfe2e7]"><img
                    src="./public/assets/training-page-7.jpg" alt="Swimming & Rescue practical training"
                    class="aspect-[1.85] w-full object-cover" loading="lazy">
                <h3 class="p-6 text-lg font-bold">Swimming &amp; Rescue</h3>
            </article>
        </div>
    </section>
    <section id="programmes" class="section bg-[#2430ce] text-white">
        <div class="container">
            <p class="eyebrow"><span></span>WHAT WE OFFER</p>
            <h2>56 programmes across ten divisions.</h2>
            <p class="mt-5 max-w-[1030px] text-lg leading-7 text-white/70">Divisions 1–5 form our safety, security
                and investigations core. Divisions 6–9 cover corporate and professional development. Division 10 is
                our hospitality vocational track, with a guaranteed link to employment.</p>
            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-5"><a href="./GTI-Programmes.html"
                    class="flex min-h-[235px] flex-col rounded-xl bg-white p-6 text-[#0b0d0f]"><span
                        class="text-[30px] font-extrabold text-[#2430ce]">01</span>
                    <h3 class="mt-3 text-base font-bold leading-6">Safety &amp; Emergency Response</h3><span
                        class="mt-auto flex items-center justify-between gap-2 pt-7 text-xs text-muted">10
                        programmes<span class="text-[#2430ce]"><svg width="17" height="17" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></span></span>
                </a><a href="./GTI-Programmes.html"
                    class="flex min-h-[235px] flex-col rounded-xl bg-white p-6 text-[#0b0d0f]"><span
                        class="text-[30px] font-extrabold text-[#2430ce]">02</span>
                    <h3 class="mt-3 text-base font-bold leading-6">Security &amp; Protective Services</h3><span
                        class="mt-auto flex items-center justify-between gap-2 pt-7 text-xs text-muted">7
                        programmes<span class="text-[#2430ce]"><svg width="17" height="17" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></span></span>
                </a><a href="./GTI-Programmes.html"
                    class="flex min-h-[235px] flex-col rounded-xl bg-white p-6 text-[#0b0d0f]"><span
                        class="text-[30px] font-extrabold text-[#2430ce]">03</span>
                    <h3 class="mt-3 text-base font-bold leading-6">Investigations &amp; Financial Crime</h3><span
                        class="mt-auto flex items-center justify-between gap-2 pt-7 text-xs text-muted">6
                        programmes<span class="text-[#2430ce]"><svg width="17" height="17" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></span></span>
                </a><a href="./GTI-Programmes.html"
                    class="flex min-h-[235px] flex-col rounded-xl bg-white p-6 text-[#0b0d0f]"><span
                        class="text-[30px] font-extrabold text-[#2430ce]">04</span>
                    <h3 class="mt-3 text-base font-bold leading-6">Cybersecurity</h3><span
                        class="mt-auto flex items-center justify-between gap-2 pt-7 text-xs text-muted">5
                        programmes<span class="text-[#2430ce]"><svg width="17" height="17" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></span></span>
                </a><a href="./GTI-Programmes.html"
                    class="flex min-h-[235px] flex-col rounded-xl bg-white p-6 text-[#0b0d0f]"><span
                        class="text-[30px] font-extrabold text-[#2430ce]">05</span>
                    <h3 class="mt-3 text-base font-bold leading-6">Command, Leadership &amp; Crisis Management</h3>
                    <span class="mt-auto flex items-center justify-between gap-2 pt-7 text-xs text-muted">6
                        programmes<span class="text-[#2430ce]"><svg width="17" height="17" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></span></span>
                </a><a href="./GTI-Programmes.html"
                    class="flex min-h-[235px] flex-col rounded-xl bg-white p-6 text-[#0b0d0f]"><span
                        class="text-[30px] font-extrabold text-[#2430ce]">06</span>
                    <h3 class="mt-3 text-base font-bold leading-6">Corporate Leadership &amp; Management Development
                    </h3><span class="mt-auto flex items-center justify-between gap-2 pt-7 text-xs text-muted">7
                        programmes<span class="text-[#2430ce]"><svg width="17" height="17" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></span></span>
                </a><a href="./GTI-Programmes.html"
                    class="flex min-h-[235px] flex-col rounded-xl bg-white p-6 text-[#0b0d0f]"><span
                        class="text-[30px] font-extrabold text-[#2430ce]">07</span>
                    <h3 class="mt-3 text-base font-bold leading-6">Workplace Wellbeing &amp; Personal Effectiveness
                    </h3><span class="mt-auto flex items-center justify-between gap-2 pt-7 text-xs text-muted">4
                        programmes<span class="text-[#2430ce]"><svg width="17" height="17" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></span></span>
                </a><a href="./GTI-Programmes.html"
                    class="flex min-h-[235px] flex-col rounded-xl bg-white p-6 text-[#0b0d0f]"><span
                        class="text-[30px] font-extrabold text-[#2430ce]">08</span>
                    <h3 class="mt-3 text-base font-bold leading-6">Communication, Customer Service &amp; Business
                        Skills</h3><span class="mt-auto flex items-center justify-between gap-2 pt-7 text-xs text-muted">4
                        programmes<span class="text-[#2430ce]"><svg width="17" height="17" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></span></span>
                </a><a href="./GTI-Programmes.html"
                    class="flex min-h-[235px] flex-col rounded-xl bg-white p-6 text-[#0b0d0f]"><span
                        class="text-[30px] font-extrabold text-[#2430ce]">09</span>
                    <h3 class="mt-3 text-base font-bold leading-6">Digital &amp; Office Productivity</h3><span
                        class="mt-auto flex items-center justify-between gap-2 pt-7 text-xs text-muted">2
                        programmes<span class="text-[#2430ce]"><svg width="17" height="17" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></span></span>
                </a><a href="./GTI-Programmes.html"
                    class="flex min-h-[235px] flex-col rounded-xl bg-white p-6 text-[#0b0d0f]"><span
                        class="text-[30px] font-extrabold text-[#2430ce]">10</span>
                    <h3 class="mt-3 text-base font-bold leading-6">Hospitality Vocational Training</h3><span
                        class="mt-auto flex items-center justify-between gap-2 pt-7 text-xs text-muted">5
                        programmes<span class="text-[#2430ce]"><svg width="17" height="17" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></span></span>
                </a></div>
            <div class="mt-10"><a href="./GTI-Programmes.html" class="button button-light !text-[#2430ce]">Browse
                    all programmes<svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a></div>
            <p class="mt-10 text-xs font-bold tracking-[1.5px] text-white/70">DOWNLOAD A CATALOGUE (PDF)</p>
            <div class="mt-4 flex flex-wrap gap-3"><a class="button button-outline !px-4 !py-3 !text-xs"
                    href="mailto:training@gage.com.mv?subject=Safety,%20Security%20%26%20Investigations%20catalogue"
                    aria-label="Request Safety, Security &amp; Investigations catalogue">Safety, Security &amp;
                    Investigations<svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M12 3v12m-4-4 4 4 4-4M5 15v5h14v-5" />
                    </svg></a><a class="button button-outline !px-4 !py-3 !text-xs"
                    href="mailto:training@gage.com.mv?subject=Corporate%20%26%20Professional%20Development%20catalogue"
                    aria-label="Request Corporate &amp; Professional Development catalogue">Corporate &amp;
                    Professional Development<svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M12 3v12m-4-4 4 4 4-4M5 15v5h14v-5" />
                    </svg></a><a class="button button-outline !px-4 !py-3 !text-xs"
                    href="mailto:training@gage.com.mv?subject=Hospitality%20Vocational%20catalogue"
                    aria-label="Request Hospitality Vocational catalogue">Hospitality Vocational<svg width="16"
                        height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                        aria-hidden="true">
                        <path d="M12 3v12m-4-4 4 4 4-4M5 15v5h14v-5" />
                    </svg></a></div>
        </div>
    </section>
    <section class="section container">
        <div
            class="flex flex-col items-start justify-between gap-6 rounded-[16px] border border-[#dfe2e7] p-7 sm:flex-row sm:items-center">
            <div class="flex items-center gap-7"><img src="./public/assets/award-mqa.png"
                    alt="Maldives Qualifications Authority" class="h-[110px] w-[125px] object-contain">
                <div>
                    <h3 class="text-xl font-bold">MQA-approved Security Officer certificate</h3>
                    <p class="mt-3 text-base leading-7 text-muted">Our flagship Certificate I in Security Officer
                        Training is approved by the Maldives Qualifications Authority.</p>
                </div>
            </div><a href="./conact.html#enquiry" class="button training-outline shrink-0">View course<svg width="17"
                    height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    aria-hidden="true">
                    <path d="M5 12h14m-6-6 6 6-6 6" />
                </svg></a>
        </div>
        <div class="mt-[120px] grid items-start gap-12 lg:grid-cols-[.6fr_1.1fr] lg:gap-24"><img
                src="./public/assets/training-page-8.jpg" alt="Dr. Aishath Shina in academic graduation dress"
                class="aspect-[.9] w-full rounded-[16px] object-cover" loading="lazy">
            <div>
                <p class="eyebrow text-[#2430ce]"><span></span>TRAINER HIGHLIGHTS</p>
                <h2>Dr. Aishath Shina</h2>
                <p class="mt-3 text-base font-bold leading-7 text-[#2430ce]">Assistant Professor; Dean, Kulliyah of
                    Education, Islamic University of Maldives</p>
                <div class="mt-6 space-y-5 text-base leading-[1.8] text-muted">
                    <p>Dr. Shina holds a PhD in Education from the University of Brunei Darussalam, a Master’s in
                        Educational Management from the University of Malaya, and a BA in Teaching English as a
                        Foreign Language from the Maldives National University.</p>
                    <p>With more than 20 years in education, she has held senior management roles at the Islamic
                        University of Maldives, Jamaluddin School, Dharumavantha School and Villa College, and leads
                        professional development workshops for teachers across the Maldives. She received the Rani
                        Award in 2023 and the National Award in 2024.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="container pb-[120px]">
        <div
            class="flex flex-col justify-between gap-9 rounded-[24px] bg-[#2430ce] px-9 py-16 text-white lg:flex-row lg:items-center lg:px-16">
            <div>
                <h2 class="!mt-0">Train your team with GAGE.</h2>
                <p class="mt-4 max-w-[740px] text-base leading-7 text-white/80">On-site at your resort, in Malé on
                    weekends and evenings, or online. Tell us who you<br class="hidden xl:block"> want to train and
                    we’ll recommend the right programme.</p>
            </div>
            <div class="flex min-w-0 flex-col gap-3 lg:min-w-[320px]"><a href="./conact.html#enquiry"
                    class="button button-light !text-[#2430ce]">Enquire about training<svg width="17" height="17"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a><a href="mailto:training@gage.com.mv" class="button button-outline">Email
                    training@gage.com.mv<svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a></div>
        </div>
    </section> --}}
@endsection
