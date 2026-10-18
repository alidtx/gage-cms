@extends('frontend.layouts.app')
@section('content')
        @include('frontend.components.hero', ['hero' => [
    'variant' => 'split',
    'section_class' => 'company-hero text-white',
    'container_class' => 'container pb-20 pt-10',
    'grid_class' => 'grid items-center gap-12 lg:grid-cols-[1.2fr_1fr] lg:gap-24',
    'heading_class' => 'mt-6 text-[40px] font-bold leading-[1.12] tracking-[-1px] sm:text-[56px]',
    'heading' => [['text' => 'Protecting lives.', 'break_class' => ''], ['text' => 'Safeguarding assets.']],
    'description' => 'From initial system design to installation, routine maintenance and accredited training, GAGE Fire Safety offers complete fire protection — keeping every facility protected, regulation-ready and response-ready.',
    'description_class' => 'mt-6 max-w-[620px] text-lg leading-[1.7] text-white/80',
    'logo' => ['src' => 'assets/fire-hero-logo.png', 'alt' => 'GAGE Fire Safety'],
    'image' => ['src' => 'assets/fire-page-0.jpg', 'width' => 763, 'height' => 763, 'alt' => 'GAGE Fire Safety technicians inspecting a fire protection control panel', 'class' => 'aspect-[.97] w-full rounded-[16px] object-cover'],
    'buttons' => [['label' => 'Request a fire safety quote', 'url' => '/contact#enquiry', 'class' => 'button button-light !text-[#c61026]', 'arrow' => 'yes'], ['label' => 'Book extinguisher servicing', 'url' => '#servicing', 'class' => 'button button-outline', 'arrow' => 'no']], 'breadcrumb' => ['title' => 'GAGE Fire Safety', 'class' => 'mb-10 flex flex-wrap gap-2 text-xs leading-6 text-white/70', 'parents' => [['label' => 'Our Companies', 'url' => route('frontend.home').'#companies']]]]])
        {{-- <section class="section container grid items-start gap-12 lg:grid-cols-2 lg:gap-24">
            <div>
                <p class="eyebrow fire-eyebrow"><span></span>WHO WE ARE</p>
                <h2>Specialist fire safety<br> since 2015.</h2>
                <div class="mt-6 space-y-6 text-base leading-[1.8] text-muted">
                    <p>Established in 2015, GAGE Fire Safety provides comprehensive fire safety solutions that safeguard
                        lives, properties and businesses across the Maldives. We were founded in response to growing
                        demand for specialised fire protection, building on GAGE’s experience in security and safety
                        services.</p>
                    <p>Today we deliver end-to-end protection: fire safety equipment, system design, installation,
                        testing, commissioning, maintenance, extinguisher servicing, after-sales support and fire safety
                        training — with a commitment to quality, compliance and technical excellence.</p>
                </div>
            </div>
            <img src="{{ asset('assets/fire-page-1.jpg') }}"
                alt="Firefighters practising fire suppression during a training exercise"
                width="895" height="500" loading="lazy" decoding="async"
                class="w-full rounded-[16px] object-cover">
        </section>
        <section id="services" class="bg-[#fbeff1]">
            <div class="section container">
                <p class="eyebrow fire-eyebrow"><span></span>SERVICES</p>
                <h2>Complete fire safety, end to end.</h2>
                <p class="section-intro max-w-[980px]">From consultancy and system design through approvals, supply and
                    installation — with monthly maintenance and after-sales service that keeps your systems compliant.
                </p>
                <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    <article class="flex flex-col rounded-[16px] border border-[#eedee1] bg-white p-7"><span
                            class="icon-box !bg-[#f8dfe3] !text-[#c61026]"><svg width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="5" y="3" width="14" height="18" rx="2" />
                                <path d="M9 8h6m-6 4h6m-6 4h4" />
                            </svg></span>
                        <h3 class="mt-7 text-lg font-bold leading-6">Fire Safety Consultancy & System Design</h3>
                        <p class="mt-3 flex-1 text-sm leading-6 text-muted">Fire safety assessments and system designs
                            that meet regulatory requirements and suit how your building is used.</p><a
                            href="./conact.html#enquiry"
                            class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-[#c61026]">View
                            service<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </article>
                    <article class="flex flex-col rounded-[16px] border border-[#eedee1] bg-white p-7"><span
                            class="icon-box !bg-[#f8dfe3] !text-[#c61026]"><svg width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path
                                    d="m14 5 5 5M3 21l7-7m0-6a6 6 0 0 0 8 8l-3-3 3-3 3 3a6 6 0 0 0-8-8l3 3-3 3-3-3Z" />
                            </svg></span>
                        <h3 class="mt-7 text-lg font-bold leading-6">System Approvals, Supply & Installation</h3>
                        <p class="mt-3 flex-1 text-sm leading-6 text-muted">MNDF design approval, certified equipment,
                            and expert installation, testing and commissioning.</p><a href="./conact.html#enquiry"
                            class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-[#c61026]">View
                            service<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </article>
                    <article class="flex flex-col rounded-[16px] border border-[#eedee1] bg-white p-7"><span
                            class="icon-box !bg-[#f8dfe3] !text-[#c61026]"><svg width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 2c4 5 1 8 4 7 7 9-1 14-6 12S2 13 9 8c-1 5 4 4 3-6Z" />
                            </svg></span>
                        <h3 class="mt-7 text-lg font-bold leading-6">Automatic Fire Suppression Systems</h3>
                        <p class="mt-3 flex-1 text-sm leading-6 text-muted">FM200, aerosol, CO2 flooding, foam and
                            kitchen hood suppression for high-risk spaces.</p><a href="./conact.html#enquiry"
                            class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-[#c61026]">View
                            service<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </article>
                    <article class="flex flex-col rounded-[16px] border border-[#eedee1] bg-white p-7"><span
                            class="icon-box !bg-[#f8dfe3] !text-[#c61026]"><svg width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m2 8 10-5 10 5-10 5L2 8Zm4 3v6l6 3 6-3v-6m4-3v9" />
                            </svg></span>
                        <h3 class="mt-7 text-lg font-bold leading-6">Fire Safety & Firefighting Training</h3>
                        <p class="mt-3 flex-1 text-sm leading-6 text-muted">Fire awareness, fire squad and brigade
                            courses, evacuation drills and hands-on extinguisher use.</p><a href="./conact.html#enquiry"
                            class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-[#c61026]">View
                            service<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </article>
                    <article class="flex flex-col rounded-[16px] border border-[#eedee1] bg-white p-7"><span
                            class="icon-box !bg-[#f8dfe3] !text-[#c61026]"><svg width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="6" y="5" width="12" height="17" rx="3" />
                                <path d="M9 5V2h6v3M6 12h12" />
                            </svg></span>
                        <h3 class="mt-7 text-lg font-bold leading-6">LPG Gas System Maintenance</h3>
                        <p class="mt-3 flex-1 text-sm leading-6 text-muted">Inspection, testing and rectification that
                            keep LPG systems safe, efficient and compliant.</p><a href="./conact.html#enquiry"
                            class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-[#c61026]">View
                            service<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </article>
                    <article class="flex flex-col rounded-[16px] border border-[#eedee1] bg-white p-7"><span
                            class="icon-box !bg-[#f8dfe3] !text-[#c61026]"><svg width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="7" y="8" width="10" height="14" rx="2" />
                                <path d="M12 8V3h6v5M8 3h8M10 13h4" />
                            </svg></span>
                        <h3 class="mt-7 text-lg font-bold leading-6">On-site Fire Extinguisher Servicing</h3>
                        <p class="mt-3 flex-1 text-sm leading-6 text-muted">Pressure testing, refilling, repairs and
                            certification at your property or resort.</p><a href="./conact.html#enquiry"
                            class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-[#c61026]">View
                            service<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </article>
                    <article class="flex flex-col rounded-[16px] border border-[#eedee1] bg-white p-7"><span
                            class="icon-box !bg-[#f8dfe3] !text-[#c61026]"><svg width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="3" y="4" width="18" height="17" rx="2" />
                                <path d="M3 10h18M8 2v4m8-4v4" />
                            </svg></span>
                        <h3 class="mt-7 text-lg font-bold leading-6">Monthly Maintenance & After-sales Service</h3>
                        <p class="mt-3 flex-1 text-sm leading-6 text-muted">Scheduled inspections and responsive
                            after-sales support that keep systems compliant all year.</p><a href="./conact.html#enquiry"
                            class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-[#c61026]">View
                            service<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </article>
                    <article class="flex flex-col rounded-[16px] border border-[#eedee1] bg-white p-7"><span
                            class="icon-box !bg-[#f8dfe3] !text-[#c61026]"><svg width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="m4 10 8-7 8 7v11H4V10Zm4 5h8m-8 3h8" />
                            </svg></span>
                        <h3 class="mt-7 text-lg font-bold leading-6">Kitchen Hood Cleaning & Annual Maintenance</h3>
                        <p class="mt-3 flex-1 text-sm leading-6 text-muted">Deep cleaning of hoods, filters, ducts and
                            suppression nozzles for safer, more hygienic kitchens.</p><a
                            href="./Service-Detail-Fire-Safety-Kitchen-Hood-Cleaning.html"
                            class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-[#c61026]">View
                            service<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </article>
                </div>
            </div>
        </section>
        <section id="amc" class="section container">
            <p class="eyebrow fire-eyebrow"><span></span>AMC PROGRAMME</p>
            <h2>Annual fire safety training &<br> maintenance.</h2>
            <p class="section-intro max-w-[1000px]">Annual training and regular equipment maintenance aren’t just legal
                requirements — they protect your employees, assets and reputation. One annual contract keeps you safe
                and compliant.</p>
            <div class="mt-12 grid gap-6 md:grid-cols-2">
                <article class="rounded-[16px] border border-[#dfe2e7] p-8">
                    <h3 class="text-xl font-bold">Fire systems inspection & maintenance</h3>
                    <ul class="fire-checks mt-4 space-y-3 text-sm leading-6 text-muted">
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Fire alarm systems</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Fire extinguishers</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Clean agent suppression</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check" aria-hidden="true">✓</span><span>LPG
                                gas detectors</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Kitchen hood suppression</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Fire hydrant and hose reel systems</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Portable and fixed pumps</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Foam and water drenching systems</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Audit-ready documentation and logbooks</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Design, regulatory approval, installation,
                                commissioning and ongoing maintenance</span></li>
                    </ul>
                </article>
                <article class="rounded-[16px] border border-[#dfe2e7] p-8">
                    <h3 class="text-xl font-bold">Annual fire safety training</h3>
                    <ul class="fire-checks mt-4 space-y-3 text-sm leading-6 text-muted">
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Fire awareness / refresher course</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Industrial fire squad course</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Fire brigade refresher training</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Evacuation and fire drills</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Hands-on extinguisher use</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Emergency response procedures</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Participation certificates</span></li>
                    </ul>
                </article>
            </div>
            <div class="my-8 flex flex-wrap gap-3"><span
                    class="flex items-center gap-2 rounded-full border border-[#dfe2e7] px-4 py-2 text-xs font-bold"><span
                        class="h-2 w-2 rounded-full bg-[#c61026]"></span>Certified fire safety experts</span><span
                    class="flex items-center gap-2 rounded-full border border-[#dfe2e7] px-4 py-2 text-xs font-bold"><span
                        class="h-2 w-2 rounded-full bg-[#c61026]"></span>Hassle-free annual scheduling</span><span
                    class="flex items-center gap-2 rounded-full border border-[#dfe2e7] px-4 py-2 text-xs font-bold"><span
                        class="h-2 w-2 rounded-full bg-[#c61026]"></span>Full regulatory compliance</span><span
                    class="flex items-center gap-2 rounded-full border border-[#dfe2e7] px-4 py-2 text-xs font-bold"><span
                        class="h-2 w-2 rounded-full bg-[#c61026]"></span>Trusted by industry, offices & hospitals</span>
            </div><a href="./conact.html#enquiry" class="button fire-button">Ask about an AMC<svg width="17" height="17"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M5 12h14m-6-6 6 6-6 6" />
                </svg></a>
        </section>
        <section class="bg-[#c61026] text-white">
            <div class="section container">
                <p class="eyebrow fire-eyebrow"><span></span>FIRE SAFETY TRAINING</p>
                <h2>Training today for a safer tomorrow.</h2>
                <p class="section-intro max-w-[980px] !text-white/80">Courses for everyone — from firefighter training
                    and fire awareness to full evacuation drills — delivered by experienced, licensed instructors with
                    real-life, hands-on scenarios.</p>
                <div class="mt-12 grid gap-6 md:grid-cols-2">
                    <article class="overflow-hidden rounded-[16px] bg-white text-black"><img
                            src="./public/assets/fire-page-1.jpg" alt="Thimarafushi Island Training Center"
                            class="aspect-[1.9] w-full object-cover" loading="lazy">
                        <div class="p-7">
                            <p class="text-xs font-bold tracking-wide text-[#c61026]">● OPERATIONAL</p>
                            <h3 class="mt-3 text-xl font-bold">Thimarafushi Island Training Center</h3>
                            <p class="mt-3 text-sm leading-6 text-muted">Live fire training and breathing apparatus (BA)
                                gallery search & rescue training. Fully approved and operational.</p><a
                                href="./conact.html#enquiry"
                                class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-[#c61026]">Enquire
                                about training<svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="M5 12h14m-6-6 6 6-6 6" />
                                </svg></a>
                        </div>
                    </article>
                    <article class="overflow-hidden rounded-[16px] bg-white text-black"><img
                            src="./public/assets/fire-page-2.jpg" alt="Thulusdoo Training Facility"
                            class="aspect-[1.9] w-full object-cover" loading="lazy">
                        <div class="p-7">
                            <p class="text-xs font-bold tracking-wide text-[#c61026]">● COMING SOON</p>
                            <h3 class="mt-3 text-xl font-bold">Thulusdoo Training Facility</h3>
                            <p class="mt-3 text-sm leading-6 text-muted">The Maldives’ first internationally approved
                                fire training center — comprehensive programmes in a state-of-the-art environment.</p><a
                                href="./conact.html#enquiry"
                                class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-[#c61026]">Enquire
                                about training<svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path d="M5 12h14m-6-6 6 6-6 6" />
                                </svg></a>
                        </div>
                    </article>
                </div>
            </div>
        </section>
        <section id="servicing" class="section container grid items-start gap-12 lg:grid-cols-2 lg:gap-24">
            <div>
                <p class="eyebrow fire-eyebrow"><span></span>SERVICE CENTER</p>
                <h2>Expert servicing of<br> extinguishers &<br> equipment.</h2>
                <p class="section-intro">On-site fire extinguisher servicing and maintenance at your property or resort
                    — for maximum convenience and minimal disruption. Or bring your equipment to our Malé service
                    center.</p>
                <div class="mt-7 flex flex-wrap gap-3"><a href="./conact.html#enquiry" class="button fire-button">Book
                        servicing<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a><a href="./conact.html" class="button fire-outline">Get directions<svg width="17"
                            height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a></div>
            </div>
            <div class="space-y-4">
                <article class="rounded-[16px] border border-[#dfe2e7] p-8">
                    <h3 class="text-xl font-bold">On-site extinguisher servicing</h3>
                    <ul class="fire-checks mt-4 space-y-3 text-sm leading-6 text-muted">
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Servicing at your property, resort or workplace</span>
                        </li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Pressure testing, refilling and repairs</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Inspection and certification to IS standards</span>
                        </li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Quick turnaround with minimal disruption</span></li>
                    </ul>
                </article>
                <article class="rounded-[16px] border border-[#dfe2e7] p-8">
                    <h3 class="text-xl font-bold">Visit our Malé service center</h3>
                    <ul class="fire-checks mt-4 space-y-3 text-sm leading-6 text-muted">
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Professional servicing and support</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Convenient drop-off and pick-up</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Experienced technicians ensuring compliance</span></li>
                        <li class="flex items-start gap-3"><span class="fire-check"
                                aria-hidden="true">✓</span><span>Technically advanced machinery</span></li>
                    </ul>
                </article>
            </div>
        </section>
        <section class="container pb-[120px]">
            <p class="eyebrow fire-eyebrow"><span></span>EQUIPMENT & SYSTEMS</p>
            <h2>Our full fire safety range.</h2>
            <p class="section-intro">Supplied, installed, tested and commissioned — with after-sales support.</p>
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <article class="rounded-[14px] border border-[#dfe2e7] p-6">
                    <h3 class="text-base font-bold">Fire Extinguishers</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Quality units, tested and inspected — your first line
                        of defence.</p>
                </article>
                <article class="rounded-[14px] border border-[#dfe2e7] p-6">
                    <h3 class="text-base font-bold">Fire Hydrant Systems</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Complete hydrant systems with all required accessories.
                    </p>
                </article>
                <article class="rounded-[14px] border border-[#dfe2e7] p-6">
                    <h3 class="text-base font-bold">Fire Hose Reels</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">25–30 m reach; resists oil, chemicals and heat.</p>
                </article>
                <article class="rounded-[14px] border border-[#dfe2e7] p-6">
                    <h3 class="text-base font-bold">Automatic Suppression</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Efficient, eco-friendly designs that prevent false
                        discharge.</p>
                </article>
                <article class="rounded-[14px] border border-[#dfe2e7] p-6">
                    <h3 class="text-base font-bold">Kitchen Hood Wet Chemical</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Hood suppression with delay timing.</p>
                </article>
                <article class="rounded-[14px] border border-[#dfe2e7] p-6">
                    <h3 class="text-base font-bold">Foam & Foam Equipment</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Tanks, pourers, deluge valves and monitors.</p>
                </article>
                <article class="rounded-[14px] border border-[#dfe2e7] p-6">
                    <h3 class="text-base font-bold">Fire Alarm Systems</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Panels, smoke, heat, multi-sensor and CO detectors.</p>
                </article>
                <article class="rounded-[14px] border border-[#dfe2e7] p-6">
                    <h3 class="text-base font-bold">Dry Riser Systems</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Corrosion-resistant valves and high-quality internal
                        finishes.</p>
                </article>
                <article class="rounded-[14px] border border-[#dfe2e7] p-6">
                    <h3 class="text-base font-bold">Fire Pumps & Controllers</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">A broad range, with testing and maintenance equipment.
                    </p>
                </article>
                <article class="rounded-[14px] border border-[#dfe2e7] p-6">
                    <h3 class="text-base font-bold">CO2 Flooding Systems</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Extinguishes surface and deep-seated fires in
                        enclosures.</p>
                </article>
                <article class="rounded-[14px] border border-[#dfe2e7] p-6">
                    <h3 class="text-base font-bold">Aerosol Fire Suppression</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Condensed aerosol units with certified panels,
                        detection and alarms.</p>
                </article>
                <article class="rounded-[14px] border border-[#dfe2e7] p-6">
                    <h3 class="text-base font-bold">Firefighting Gear</h3>
                    <p class="mt-3 text-sm leading-6 text-muted">Commercial and residential PPE and equipment.</p>
                </article>
            </div>
            <div class="mt-8"><a href="https://shop.gage.com.mv" class="button fire-outline">Buy equipment at GAGE
                    Store<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a></div>
        </section>
        <section class="container pb-[120px]">
            <div
                class="flex flex-col justify-between gap-9 rounded-[24px] bg-[#c61026] px-9 py-16 text-white lg:flex-row lg:items-center lg:px-16">
                <div>
                    <h2 class="!mt-0">Is your building fire-ready?</h2>
                    <p class="mt-4 max-w-[740px] text-base leading-7 text-white/80">Tell us about your property. We’ll
                        assess your fire safety needs and recommend the<br class="hidden xl:block"> right systems,
                        servicing and training.</p>
                </div>
                <div class="flex min-w-[290px] flex-col gap-3"><a href="./conact.html#enquiry"
                        class="button button-light !text-[#c61026]">Request a fire safety quote<svg width="17"
                            height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            aria-hidden="true">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg></a><a href="tel:+9603304055" class="button button-outline">Call +960 330 4055<svg
                            width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" aria-hidden="true">
                            <path
                                d="M5 3h4l2 5-3 2a15 15 0 0 0 6 6l2-3 5 2v4a2 2 0 0 1-2 2A18 18 0 0 1 3 5a2 2 0 0 1 2-2Z" />
                        </svg></a></div>
            </div>
        </section> --}}
@endsection