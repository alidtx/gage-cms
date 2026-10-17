@extends('frontend.layouts.app')
@section('content')

        @include('frontend.components.hero', ['hero' => [
    'variant' => 'text',
    'section_class' => 'bg-black text-white',
    'container_class' => 'container pb-20 pt-10 lg:pb-24',
    'heading_class' => 'mt-7 max-w-[1060px] text-[38px] font-bold leading-[1.12] tracking-[-1px] sm:text-[56px]',
    'heading' => [['text' => 'Let’s talk about what you need to', 'break_class' => 'hidden lg:block'], ['text' => 'protect.']],
    'description' => 'Send us an enquiry or request a quote. Tell us a little about your property and what you need — we’ll make sure the right GAGE team gets back to you.',
    'description_class' => 'mt-6 max-w-[1050px] text-lg leading-[1.7] text-[#b9bec4]',
    'eyebrow' => 'CONTACT US',
    'eyebrow_class' => 'eyebrow', 'breadcrumb' => ['title' => 'Contact', 'class' => 'mb-10 flex gap-3 text-xs text-[#b9bec4]']]])
        <section class="container py-24 lg:py-24">
            <div class="grid items-stretch gap-6 lg:grid-cols-[2fr_1fr]">
                <form id="enquiry" class="rounded-[20px] border border-[#dfe2e7] p-6 sm:p-12"
                    aria-labelledby="enquiry-heading" method="POST" action="{{ route('contact.store') }}">
                    @csrf
<input type="hidden" name="enquiry_type" value="quote">
@if(session('status'))<div class="contact-notice contact-success" role="status">{{ session('status') }}</div>@endif
@if($errors->any())
<div class="contact-notice contact-error" role="alert"><p>Please correct the following:</p><ul>
@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
</ul></div>
@endif
<h2 id="enquiry-heading" class="!mt-0 !text-[30px]">Request a quote</h2>
                    <p class="mt-2 text-base text-[#9aa0a7]">Fields marked * are required.</p>
                    <div class="mt-8 grid gap-x-6 gap-y-6 sm:grid-cols-2">
                        <div><label for="full-name" class="mb-2 block text-sm font-bold">Full name *</label><input
                                id="full-name" name="full_name" maxlength="255" value="{{ old('full_name') }}" @if($errors->has('full_name')) aria-invalid="true" @endif type="text" placeholder="Your name"
                                class="contact-control" required autocomplete="name"></div>
                        <div><label for="company" class="mb-2 block text-sm font-bold">Company / property</label><input
                                id="company" name="company" maxlength="255" value="{{ old('company') }}" @if($errors->has('company')) aria-invalid="true" @endif type="text" placeholder="e.g. resort, bank, business"
                                class="contact-control" autocomplete="organization"></div>
                        <div><label for="email" class="mb-2 block text-sm font-bold">Email *</label><input maxlength="255" value="{{ old('email_address') }}" @if($errors->has('email_address')) aria-invalid="true" @endif id="email"
                                name="email_address" type="email" placeholder="name@company.com" class="contact-control"
                                required autocomplete="email"></div>
                        <div><label for="phone" class="mb-2 block text-sm font-bold">Phone *</label><input maxlength="255" value="{{ old('phone_number') }}" @if($errors->has('phone_number')) aria-invalid="true" @endif id="phone"
                                name="phone_number" type="tel" placeholder="+960" class="contact-control" required
                                autocomplete="tel"></div>
                        <div><label for="gage-company" class="mb-2 block text-sm font-bold">Which GAGE company can help?
                                *</label><select id="gage-company" name="gage_company" class="contact-control" required>
                                <option value="" @selected(old('gage_company', '') === '')>Select a company</option>
                                <option value="security" @selected(old('gage_company', '') === 'security')>GAGE Security</option>
                                <option value="fire" @selected(old('gage_company', '') === 'fire')>GAGE Fire Safety</option>
                                <option value="training" @selected(old('gage_company', '') === 'training')>GAGE Training Institute</option>
                                <option value="technology" @selected(old('gage_company', '') === 'technology')>GAGE Technology</option>
                                <option value="unsure" @selected(old('gage_company', '') === 'unsure')>Not sure, help me choose</option>
                            </select></div>
                        <div><label for="service" class="mb-2 block text-sm font-bold">Service of
                                interest</label><select id="service" name="service" class="contact-control">
                                <option value="" @selected(old('service', '') === '')>Select a service</option>
                                <option value="security" @selected(old('service', '') === 'security')>Security services</option>
                                <option value="fire" @selected(old('service', '') === 'fire')>Fire safety</option>
                                <option value="training" @selected(old('service', '') === 'training')>Training programmes</option>
                                <option value="technology" @selected(old('service', '') === 'technology')>Technology solutions</option>
                                <option value="other" @selected(old('service', '') === 'other')>Other / not sure</option>
                            </select></div>
                        <div><label for="island" class="mb-2 block text-sm font-bold">Island / atoll</label><input
                                id="island" name="island" maxlength="255" value="{{ old('island') }}" @if($errors->has('island')) aria-invalid="true" @endif type="text" placeholder="e.g. Malé, Baa Atoll"
                                class="contact-control"></div>
                        <div><label for="contact-method" class="mb-2 block text-sm font-bold">Preferred contact
                                method</label><select id="contact-method" name="contact_method" class="contact-control">
                                <option value="either" @selected(old('contact_method', 'either') === 'either')>Phone or email</option>
                                <option value="phone" @selected(old('contact_method', 'either') === 'phone')>Phone</option>
                                <option value="email" @selected(old('contact_method', 'either') === 'email')>Email</option>
                            </select></div>
                        <div class="sm:col-span-2"><label for="message" class="mb-2 block text-sm font-bold">How can we
                                help? *</label><textarea id="message" name="message" maxlength="10000" required rows="5"
                                class="contact-control resize-y"
                                placeholder="Tell us about your property and what you need.">{{ old('message') }}</textarea></div>
                    </div><label class="mt-6 flex items-start gap-3 text-sm leading-6 text-muted"><input value="1" @checked(old('consent')) type="checkbox"
                            name="consent" required class="mt-1 h-5 w-5 shrink-0 accent-black"><span>I agree to GAGE
                            contacting me about this enquiry and to the handling of my details as described in the <a
                                href="mailto:info@gage.com.mv?subject=Privacy%20policy" class="underline underline-offset-2">Privacy
                                Policy</a>.</span></label><button type="submit"
                        class="mt-7 inline-flex items-center gap-3 rounded-md bg-black px-6 py-4 text-sm font-bold text-white">Send
                        enquiry<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="m22 2-7 20-4-9-9-4 20-7Z" />
                            <path d="M22 2 11 13" />
                        </svg></button>
                    <p class="mt-4 text-sm text-[#9aa0a7]">* Required field</p>
                </form>
                <aside aria-label="Contact details" class="flex flex-col gap-4">
                    <section class="rounded-[16px] bg-[#f4f5f7] p-7">
                        <div class="flex items-center gap-4"><span class="icon-box"><svg width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 1 1 16 0Z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg></span>
                            <h2 class="!mt-0 !text-lg !tracking-normal">Head office</h2>
                        </div>
                        <p class="mt-5 text-base leading-7 text-muted">GAGE Private Limited<br>H. Noomuraka, 1st Floor,
                            Hadheebee Magu<br>Malé 20086, Republic of Maldives</p>
                    </section>
                    <section class="rounded-[16px] bg-[#f4f5f7] p-7">
                        <div class="flex items-center gap-4"><span class="icon-box"><svg width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path
                                        d="M22 16.9v3a2 2 0 0 1-2.2 2A20 20 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7l.4 3a2 2 0 0 1-.6 1.7L7.6 9.7a16 16 0 0 0 6.7 6.7l1.3-1.3a2 2 0 0 1 1.7-.6l3 .4a2 2 0 0 1 1.7 2Z" />
                                </svg></span>
                            <h2 class="!mt-0 !text-lg !tracking-normal">Call us</h2>
                        </div>
                        <p class="mt-5 text-base leading-7 text-muted"><a href="tel:+9603304055"
                                class="font-bold text-black">+960 330 4055</a><br>Round-the-clock support</p>
                    </section>
                    <section class="rounded-[16px] bg-[#f4f5f7] p-7">
                        <div class="flex items-center gap-4"><span class="icon-box"><svg width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <rect x="3" y="5" width="18" height="14" rx="2" />
                                    <path d="m3 6 9 7 9-7" />
                                </svg></span>
                            <h2 class="!mt-0 !text-lg !tracking-normal">Email us</h2>
                        </div>
                        <p class="mt-5 text-base leading-7 text-muted">General & quotes: <a
                                href="mailto:info@gage.com.mv">info@gage.com.mv</a><br>Training: <a
                                href="mailto:training@gage.com.mv">training@gage.com.mv</a></p>
                    </section>
                    <section class="mt-8 rounded-[16px] bg-[#442424] p-7 text-white lg:mt-auto">
                        <div class="flex items-center gap-5">
                            <div class="shrink-0 text-center"><img src="{{ asset('assets/security.png') }}" alt="GAGE Store"
                                    class="w-28 mix-blend-screen"><span class="text-[10px] tracking-[5px]">STORE</span>
                            </div>
                            <div>
                                <h2 class="!mt-0 !text-lg !tracking-normal">Buying products?</h2>
                                <p class="mt-2 text-sm leading-6 text-[#d6cfcf]">Shop safety & security products online.
                                </p>
                            </div>
                        </div><a href="https://shop.gage.com.mv" target="_blank" rel="noreferrer"
                            class="button button-light mt-8 w-full !text-[#442424]">Shop at GAGE Store<svg width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M7 7h10v10M7 17 17 7" />
                            </svg></a>
                    </section>
                </aside>
            </div>
            <div class="relative mt-24 h-[360px] overflow-hidden rounded-[16px] sm:h-[460px]"
                aria-label="GAGE head office location"><img src="{{ asset('assets/contact-0.jpg') }}"
                    alt="Street map of Malé near GAGE head office" class="h-full w-full object-cover object-[70%_50%]"
                    loading="lazy">
                <div class="absolute left-4 top-[42%] flex items-center gap-4 sm:left-1/2 sm:top-1/3"><span
                        class="h-7 w-7 shrink-0 rounded-full border-[5px] border-white bg-black shadow-lg"></span>
                    <div class="w-[220px] rounded-xl bg-white p-5 shadow-sm sm:w-[300px]">
                        <h2 class="!mt-0 !text-base !tracking-normal">GAGE head office</h2>
                        <p class="mt-1 text-sm text-muted">H. Noomuraka, 1st Floor, Malé</p><a
                            href="https://www.google.com/maps/search/?api=1&query=GAGE+Private+Limited+Male+Maldives"
                            target="_blank" rel="noreferrer"
                            class="mt-2 inline-flex items-center gap-2 text-sm font-bold">Get directions<svg width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M5 12h14m-6-6 6 6-6 6" />
                            </svg></a>
                    </div>
                </div>
            </div>
        </section>

@endsection
