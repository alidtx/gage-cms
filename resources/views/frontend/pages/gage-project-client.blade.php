@extends('frontend.layouts.app')
@section('content')
    <section class="bg-black text-white">
        <div class="container pb-20 pt-10">
            <nav aria-label="Breadcrumb" class="flex gap-2 text-xs text-white/70"><a href="./index.html">Home</a><span
                    aria-hidden="true">›</span><span class="font-bold text-white">Projects &amp; Clients</span></nav>
            <p class="eyebrow mt-12"><span></span>PROJECTS &amp; CLIENTS</p>
            <h1 class="mt-6 max-w-[1100px] text-[38px] font-extrabold leading-[1.15] tracking-[-1px] sm:text-[56px]">
                Protecting the Maldives, atoll by<br class="hidden lg:block"> atoll.</h1>
            <p class="mt-6 max-w-[1080px] text-lg leading-[1.7] text-white/80">From private islands in Noonu to
                banks and hospitals in Hulhumalé, GAGE companies protect some of the country’s most important
                places. Explore where we work and who we work with.</p>
        </div>
    </section>
    <section class="section container projects-browser">
        <div class="flex flex-wrap items-center gap-3" role="group" aria-label="Show work by company"><span
                class="mr-2 text-sm font-bold">Show work by</span><input class="project-filter sr-only" type="radio"
                name="project-company" id="company-0"><label for="company-0" class="project-filter-label">All
                companies</label><input class="project-filter sr-only" type="radio" name="project-company"
                id="company-1"><label for="company-1" class="project-filter-label">GAGE Security</label><input
                class="project-filter sr-only" type="radio" name="project-company" id="company-2" checked><label
                for="company-2" class="project-filter-label">GAGE Fire Safety</label><input class="project-filter sr-only"
                type="radio" name="project-company" id="company-3"><label for="company-3"
                class="project-filter-label">GAGE Training Institute</label><input class="project-filter sr-only"
                type="radio" name="project-company" id="company-4"><label for="company-4"
                class="project-filter-label">GAGE Technology</label></div>
        <div class="projects-empty mt-8 rounded-2xl border border-[#dfe2e7] p-10">
            <h2 class="!mt-0 !text-2xl">More projects coming soon.</h2>
            <p class="mt-4 text-muted">Project locations for this company have not been added yet. Contact our team
                to discuss relevant experience for your property.</p><a href="./conact.html#enquiry"
                class="button mt-6 bg-black text-white">Enquire about a project<svg width="17" height="17"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M5 12h14m-6-6 6 6-6 6" />
                </svg></a>
        </div>
        <div class="projects-map-layout mt-8"><input type="radio" name="project-location" id="project-0"
                class="project-location sr-only" aria-label="JA Manafaru Resort"><input type="radio"
                name="project-location" id="project-1" class="project-location sr-only"
                aria-label="JW Marriott Maldives Resort"><input type="radio" name="project-location" id="project-2"
                class="project-location sr-only" aria-label="Soneva Jani Resort" checked><input type="radio"
                name="project-location" id="project-3" class="project-location sr-only"
                aria-label="Siyam World Resort"><input type="radio" name="project-location" id="project-4"
                class="project-location sr-only" aria-label="Velaa Private Island Resort"><input type="radio"
                name="project-location" id="project-5" class="project-location sr-only"
                aria-label="Seaside Finolhu Resort"><input type="radio" name="project-location" id="project-6"
                class="project-location sr-only" aria-label="Milaidhoo Island Resort"><input type="radio"
                name="project-location" id="project-7" class="project-location sr-only"
                aria-label="Reethi Beach Resort"><input type="radio" name="project-location" id="project-8"
                class="project-location sr-only" aria-label="Soneva Fushi Resort"><input type="radio"
                name="project-location" id="project-9" class="project-location sr-only"
                aria-label="OBLU Helengeli Resort"><input type="radio" name="project-location" id="project-10"
                class="project-location sr-only" aria-label="Summer Island Resort"><input type="radio"
                name="project-location" id="project-11" class="project-location sr-only" aria-label="Fari Campus"><input
                type="radio" name="project-location" id="project-12" class="project-location sr-only"
                aria-label="Maxx Royal Resort"><input type="radio" name="project-location" id="project-13"
                class="project-location sr-only" aria-label="Club Med Finolhu Resort"><input type="radio"
                name="project-location" id="project-14" class="project-location sr-only"
                aria-label="Club Med Kani Resort"><input type="radio" name="project-location" id="project-15"
                class="project-location sr-only" aria-label="Huvafen Fushi Maldives Resort"><input type="radio"
                name="project-location" id="project-16" class="project-location sr-only"
                aria-label="One&amp;Only Reethi Rah Resort"><input type="radio" name="project-location"
                id="project-17" class="project-location sr-only" aria-label="Sheraton Maldives Full Moon Resort"><input
                type="radio" name="project-location" id="project-18" class="project-location sr-only"
                aria-label="Dusit D2 Resort"><input type="radio" name="project-location" id="project-19"
                class="project-location sr-only" aria-label="Taj Exotica Resort"><input type="radio"
                name="project-location" id="project-20" class="project-location sr-only"
                aria-label="Hard Rock Resort"><input type="radio" name="project-location" id="project-21"
                class="project-location sr-only" aria-label="JW Marriott Emboodhoo Lagoon Resort"><input type="radio"
                name="project-location" id="project-22" class="project-location sr-only"
                aria-label="Waldorf Astoria Maldives Resort"><input type="radio" name="project-location"
                id="project-23" class="project-location sr-only" aria-label="OZEN Life Maadhoo"><input type="radio"
                name="project-location" id="project-24" class="project-location sr-only"
                aria-label="W Maldives Resort"><input type="radio" name="project-location" id="project-25"
                class="project-location sr-only" aria-label="Conrad Maldives Rangali Island"><input type="radio"
                name="project-location" id="project-26" class="project-location sr-only"
                aria-label="Barceló Whale Lagoon Maldives"><input type="radio" name="project-location" id="project-27"
                class="project-location sr-only" aria-label="NH Kuda Rah Resort"><input type="radio"
                name="project-location" id="project-28" class="project-location sr-only"
                aria-label="Kunaavashi Resort"><input type="radio" name="project-location" id="project-29"
                class="project-location sr-only" aria-label="Baglioni Resort"><input type="radio"
                name="project-location" id="project-30" class="project-location sr-only"
                aria-label="Six Senses Maldives Resort"><input type="radio" name="project-location" id="project-31"
                class="project-location sr-only" aria-label="Robinson Maldives Resort">
            <div class="project-map relative self-start overflow-hidden rounded-[16px] bg-[#002e40]"><img
                    src="./public/assets/projects-atoll-map.png"
                    alt="Illustrated Maldives atoll map with approximate fire safety project locations"
                    class="block w-full"><label for="project-0" class="project-pin project-pin-0"
                    style="left:45%;top:6%" title="JA Manafaru Resort"><span class="sr-only">JA Manafaru
                        Resort</span></label><label for="project-1" class="project-pin project-pin-1"
                    style="left:49%;top:16%" title="JW Marriott Maldives Resort"><span class="sr-only">JW Marriott
                        Maldives Resort</span></label><label for="project-2" class="project-pin project-pin-2"
                    style="left:52%;top:22%" title="Soneva Jani Resort"><span class="sr-only">Soneva Jani
                        Resort</span></label><label for="project-3" class="project-pin project-pin-3"
                    style="left:47%;top:27%" title="Siyam World Resort"><span class="sr-only">Siyam World
                        Resort</span></label><label for="project-4" class="project-pin project-pin-4"
                    style="left:44%;top:25%" title="Velaa Private Island Resort"><span class="sr-only">Velaa Private
                        Island Resort</span></label><label for="project-5" class="project-pin project-pin-5"
                    style="left:54%;top:30%" title="Seaside Finolhu Resort"><span class="sr-only">Seaside Finolhu
                        Resort</span></label><label for="project-6" class="project-pin project-pin-6"
                    style="left:57%;top:28%" title="Milaidhoo Island Resort"><span class="sr-only">Milaidhoo Island
                        Resort</span></label><label for="project-7" class="project-pin project-pin-7"
                    style="left:56%;top:33%" title="Reethi Beach Resort"><span class="sr-only">Reethi Beach
                        Resort</span></label><label for="project-8" class="project-pin project-pin-8"
                    style="left:53%;top:31%" title="Soneva Fushi Resort"><span class="sr-only">Soneva Fushi
                        Resort</span></label><label for="project-9" class="project-pin project-pin-9"
                    style="left:56%;top:37%" title="OBLU Helengeli Resort"><span class="sr-only">OBLU Helengeli
                        Resort</span></label><label for="project-10" class="project-pin project-pin-10"
                    style="left:57%;top:39%" title="Summer Island Resort"><span class="sr-only">Summer Island
                        Resort</span></label><label for="project-11" class="project-pin project-pin-11"
                    style="left:59%;top:40%" title="Fari Campus"><span class="sr-only">Fari
                        Campus</span></label><label for="project-12" class="project-pin project-pin-12"
                    style="left:57%;top:42%" title="Maxx Royal Resort"><span class="sr-only">Maxx Royal
                        Resort</span></label><label for="project-13" class="project-pin project-pin-13"
                    style="left:59%;top:43%" title="Club Med Finolhu Resort"><span class="sr-only">Club Med Finolhu
                        Resort</span></label><label for="project-14" class="project-pin project-pin-14"
                    style="left:58%;top:44%" title="Club Med Kani Resort"><span class="sr-only">Club Med Kani
                        Resort</span></label><label for="project-15" class="project-pin project-pin-15"
                    style="left:55%;top:45%" title="Huvafen Fushi Maldives Resort"><span class="sr-only">Huvafen
                        Fushi Maldives Resort</span></label><label for="project-16" class="project-pin project-pin-16"
                    style="left:60%;top:46%" title="One&amp;Only Reethi Rah Resort"><span class="sr-only">One&amp;Only
                        Reethi Rah
                        Resort</span></label><label for="project-17" class="project-pin project-pin-17"
                    style="left:57%;top:47%" title="Sheraton Maldives Full Moon Resort"><span class="sr-only">Sheraton
                        Maldives Full Moon Resort</span></label><label for="project-18" class="project-pin project-pin-18"
                    style="left:58%;top:48%" title="Dusit D2 Resort"><span class="sr-only">Dusit D2
                        Resort</span></label><label for="project-19" class="project-pin project-pin-19"
                    style="left:58%;top:49%" title="Taj Exotica Resort"><span class="sr-only">Taj Exotica
                        Resort</span></label><label for="project-20" class="project-pin project-pin-20"
                    style="left:59%;top:50%" title="Hard Rock Resort"><span class="sr-only">Hard Rock
                        Resort</span></label><label for="project-21" class="project-pin project-pin-21"
                    style="left:57%;top:51%" title="JW Marriott Emboodhoo Lagoon Resort"><span class="sr-only">JW
                        Marriott Emboodhoo Lagoon
                        Resort</span></label><label for="project-22" class="project-pin project-pin-22"
                    style="left:60%;top:52%" title="Waldorf Astoria Maldives Resort"><span class="sr-only">Waldorf
                        Astoria Maldives Resort</span></label><label for="project-23" class="project-pin project-pin-23"
                    style="left:59%;top:53%" title="OZEN Life Maadhoo"><span class="sr-only">OZEN Life
                        Maadhoo</span></label><label for="project-24" class="project-pin project-pin-24"
                    style="left:44%;top:41%" title="W Maldives Resort"><span class="sr-only">W Maldives
                        Resort</span></label><label for="project-25" class="project-pin project-pin-25"
                    style="left:45%;top:46%" title="Conrad Maldives Rangali Island"><span class="sr-only">Conrad Maldives
                        Rangali
                        Island</span></label><label for="project-26" class="project-pin project-pin-26"
                    style="left:46%;top:47%" title="Barceló Whale Lagoon Maldives"><span class="sr-only">Barceló
                        Whale Lagoon Maldives</span></label><label for="project-27" class="project-pin project-pin-27"
                    style="left:47%;top:48%" title="NH Kuda Rah Resort"><span class="sr-only">NH Kuda Rah
                        Resort</span></label><label for="project-28" class="project-pin project-pin-28"
                    style="left:56%;top:58%" title="Kunaavashi Resort"><span class="sr-only">Kunaavashi
                        Resort</span></label><label for="project-29" class="project-pin project-pin-29"
                    style="left:43%;top:55%" title="Baglioni Resort"><span class="sr-only">Baglioni
                        Resort</span></label><label for="project-30" class="project-pin project-pin-30"
                    style="left:47%;top:63%" title="Six Senses Maldives Resort"><span class="sr-only">Six Senses Maldives
                        Resort</span></label><label for="project-31" class="project-pin project-pin-31"
                    style="left:55%;top:89%" title="Robinson Maldives Resort"><span class="sr-only">Robinson
                        Maldives Resort</span></label>
                <div class="project-tooltip absolute rounded-lg bg-white p-4 shadow-lg">
                    <div class="project-tip project-tip-0">
                        <p class="text-sm font-extrabold">JA Manafaru Resort</p>
                        <p class="mt-2 text-xs text-muted">Haa Alifu Atoll</p>
                    </div>
                    <div class="project-tip project-tip-1">
                        <p class="text-sm font-extrabold">JW Marriott Maldives Resort</p>
                        <p class="mt-2 text-xs text-muted">Shaviyani Atoll</p>
                    </div>
                    <div class="project-tip project-tip-2">
                        <p class="text-sm font-extrabold">Soneva Jani Resort</p>
                        <p class="mt-2 text-xs text-muted">Noonu Atoll</p>
                    </div>
                    <div class="project-tip project-tip-3">
                        <p class="text-sm font-extrabold">Siyam World Resort</p>
                        <p class="mt-2 text-xs text-muted">Noonu Atoll</p>
                    </div>
                    <div class="project-tip project-tip-4">
                        <p class="text-sm font-extrabold">Velaa Private Island Resort</p>
                        <p class="mt-2 text-xs text-muted">Noonu Atoll</p>
                    </div>
                    <div class="project-tip project-tip-5">
                        <p class="text-sm font-extrabold">Seaside Finolhu Resort</p>
                        <p class="mt-2 text-xs text-muted">Baa Atoll</p>
                    </div>
                    <div class="project-tip project-tip-6">
                        <p class="text-sm font-extrabold">Milaidhoo Island Resort</p>
                        <p class="mt-2 text-xs text-muted">Baa Atoll</p>
                    </div>
                    <div class="project-tip project-tip-7">
                        <p class="text-sm font-extrabold">Reethi Beach Resort</p>
                        <p class="mt-2 text-xs text-muted">Baa Atoll</p>
                    </div>
                    <div class="project-tip project-tip-8">
                        <p class="text-sm font-extrabold">Soneva Fushi Resort</p>
                        <p class="mt-2 text-xs text-muted">Baa Atoll</p>
                    </div>
                    <div class="project-tip project-tip-9">
                        <p class="text-sm font-extrabold">OBLU Helengeli Resort</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (North Malé)</p>
                    </div>
                    <div class="project-tip project-tip-10">
                        <p class="text-sm font-extrabold">Summer Island Resort</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (North Malé)</p>
                    </div>
                    <div class="project-tip project-tip-11">
                        <p class="text-sm font-extrabold">Fari Campus</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (North Malé)</p>
                    </div>
                    <div class="project-tip project-tip-12">
                        <p class="text-sm font-extrabold">Maxx Royal Resort</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (North Malé)</p>
                    </div>
                    <div class="project-tip project-tip-13">
                        <p class="text-sm font-extrabold">Club Med Finolhu Resort</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (North Malé)</p>
                    </div>
                    <div class="project-tip project-tip-14">
                        <p class="text-sm font-extrabold">Club Med Kani Resort</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (North Malé)</p>
                    </div>
                    <div class="project-tip project-tip-15">
                        <p class="text-sm font-extrabold">Huvafen Fushi Maldives Resort</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (North Malé)</p>
                    </div>
                    <div class="project-tip project-tip-16">
                        <p class="text-sm font-extrabold">One&amp;Only Reethi Rah Resort</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (North Malé)</p>
                    </div>
                    <div class="project-tip project-tip-17">
                        <p class="text-sm font-extrabold">Sheraton Maldives Full Moon Resort</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (North Malé)</p>
                    </div>
                    <div class="project-tip project-tip-18">
                        <p class="text-sm font-extrabold">Dusit D2 Resort</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (North Malé)</p>
                    </div>
                    <div class="project-tip project-tip-19">
                        <p class="text-sm font-extrabold">Taj Exotica Resort</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (South Malé)</p>
                    </div>
                    <div class="project-tip project-tip-20">
                        <p class="text-sm font-extrabold">Hard Rock Resort</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (South Malé)</p>
                    </div>
                    <div class="project-tip project-tip-21">
                        <p class="text-sm font-extrabold">JW Marriott Emboodhoo Lagoon Resort</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (South Malé)</p>
                    </div>
                    <div class="project-tip project-tip-22">
                        <p class="text-sm font-extrabold">Waldorf Astoria Maldives Resort</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (South Malé)</p>
                    </div>
                    <div class="project-tip project-tip-23">
                        <p class="text-sm font-extrabold">OZEN Life Maadhoo</p>
                        <p class="mt-2 text-xs text-muted">Kaafu Atoll (South Malé)</p>
                    </div>
                    <div class="project-tip project-tip-24">
                        <p class="text-sm font-extrabold">W Maldives Resort</p>
                        <p class="mt-2 text-xs text-muted">Alifu Alifu Atoll (North Ari)</p>
                    </div>
                    <div class="project-tip project-tip-25">
                        <p class="text-sm font-extrabold">Conrad Maldives Rangali Island</p>
                        <p class="mt-2 text-xs text-muted">Alifu Dhaalu Atoll (South Ari)</p>
                    </div>
                    <div class="project-tip project-tip-26">
                        <p class="text-sm font-extrabold">Barceló Whale Lagoon Maldives</p>
                        <p class="mt-2 text-xs text-muted">Alifu Dhaalu Atoll (South Ari)</p>
                    </div>
                    <div class="project-tip project-tip-27">
                        <p class="text-sm font-extrabold">NH Kuda Rah Resort</p>
                        <p class="mt-2 text-xs text-muted">Alifu Dhaalu Atoll (South Ari)</p>
                    </div>
                    <div class="project-tip project-tip-28">
                        <p class="text-sm font-extrabold">Kunaavashi Resort</p>
                        <p class="mt-2 text-xs text-muted">Vaavu Atoll</p>
                    </div>
                    <div class="project-tip project-tip-29">
                        <p class="text-sm font-extrabold">Baglioni Resort</p>
                        <p class="mt-2 text-xs text-muted">Dhaalu Atoll</p>
                    </div>
                    <div class="project-tip project-tip-30">
                        <p class="text-sm font-extrabold">Six Senses Maldives Resort</p>
                        <p class="mt-2 text-xs text-muted">Laamu Atoll</p>
                    </div>
                    <div class="project-tip project-tip-31">
                        <p class="text-sm font-extrabold">Robinson Maldives Resort</p>
                        <p class="mt-2 text-xs text-muted">Gaafu Alifu Atoll</p>
                    </div>
                </div>
            </div>
            <div class="project-list rounded-[16px] border border-[#dfe2e7] p-7">
                <h2 class="!mt-0 !text-[22px] !tracking-normal">32 resort projects</h2>
                <p class="mt-3 text-sm leading-6 text-muted">Fire safety systems supplied and installed by GAGE Fire
                    Safety.<br>Locations are approximate.</p>
                <div class="mt-7 border-t border-[#dfe2e7]">
                    <section class="border-b border-[#dfe2e7] py-4 last:border-0">
                        <h3 class="mb-2 text-[11px] font-bold uppercase tracking-[1px] text-[#9198a1]">Haa Alifu
                            Atoll</h3><label for="project-0" class="project-row project-row-0">JA Manafaru
                            Resort</label>
                    </section>
                    <section class="border-b border-[#dfe2e7] py-4 last:border-0">
                        <h3 class="mb-2 text-[11px] font-bold uppercase tracking-[1px] text-[#9198a1]">Shaviyani
                            Atoll</h3><label for="project-1" class="project-row project-row-1">JW Marriott Maldives
                            Resort</label>
                    </section>
                    <section class="border-b border-[#dfe2e7] py-4 last:border-0">
                        <h3 class="mb-2 text-[11px] font-bold uppercase tracking-[1px] text-[#9198a1]">Noonu Atoll
                        </h3><label for="project-2" class="project-row project-row-2">Soneva Jani
                            Resort</label><label for="project-3" class="project-row project-row-3">Siyam World
                            Resort</label><label for="project-4" class="project-row project-row-4">Velaa Private
                            Island Resort</label>
                    </section>
                    <section class="border-b border-[#dfe2e7] py-4 last:border-0">
                        <h3 class="mb-2 text-[11px] font-bold uppercase tracking-[1px] text-[#9198a1]">Baa Atoll
                        </h3><label for="project-5" class="project-row project-row-5">Seaside Finolhu
                            Resort</label><label for="project-6" class="project-row project-row-6">Milaidhoo Island
                            Resort</label><label for="project-7" class="project-row project-row-7">Reethi Beach
                            Resort</label><label for="project-8" class="project-row project-row-8">Soneva Fushi
                            Resort</label>
                    </section>
                    <section class="border-b border-[#dfe2e7] py-4 last:border-0">
                        <h3 class="mb-2 text-[11px] font-bold uppercase tracking-[1px] text-[#9198a1]">Kaafu Atoll
                            (North Malé)</h3><label for="project-9" class="project-row project-row-9">OBLU Helengeli
                            Resort</label><label for="project-10" class="project-row project-row-10">Summer Island
                            Resort</label><label for="project-11" class="project-row project-row-11">Fari
                            Campus</label><label for="project-12" class="project-row project-row-12">Maxx Royal
                            Resort</label><label for="project-13" class="project-row project-row-13">Club Med
                            Finolhu Resort</label><label for="project-14" class="project-row project-row-14">Club
                            Med Kani Resort</label><label for="project-15" class="project-row project-row-15">Huvafen
                            Fushi Maldives Resort</label><label for="project-16"
                            class="project-row project-row-16">One&amp;Only Reethi Rah
                            Resort</label><label for="project-17" class="project-row project-row-17">Sheraton
                            Maldives Full Moon Resort</label><label for="project-18"
                            class="project-row project-row-18">Dusit D2 Resort</label>
                    </section>
                    <section class="border-b border-[#dfe2e7] py-4 last:border-0">
                        <h3 class="mb-2 text-[11px] font-bold uppercase tracking-[1px] text-[#9198a1]">Kaafu Atoll
                            (South Malé)</h3><label for="project-19" class="project-row project-row-19">Taj Exotica
                            Resort</label><label for="project-20" class="project-row project-row-20">Hard Rock
                            Resort</label><label for="project-21" class="project-row project-row-21">JW Marriott
                            Emboodhoo Lagoon Resort</label><label for="project-22"
                            class="project-row project-row-22">Waldorf Astoria Maldives Resort</label><label
                            for="project-23" class="project-row project-row-23">OZEN Life Maadhoo</label>
                    </section>
                    <section class="border-b border-[#dfe2e7] py-4 last:border-0">
                        <h3 class="mb-2 text-[11px] font-bold uppercase tracking-[1px] text-[#9198a1]">Alifu Alifu
                            Atoll (North Ari)</h3><label for="project-24" class="project-row project-row-24">W
                            Maldives Resort</label>
                    </section>
                    <section class="border-b border-[#dfe2e7] py-4 last:border-0">
                        <h3 class="mb-2 text-[11px] font-bold uppercase tracking-[1px] text-[#9198a1]">Alifu Dhaalu
                            Atoll (South Ari)</h3><label for="project-25" class="project-row project-row-25">Conrad
                            Maldives Rangali Island</label><label for="project-26"
                            class="project-row project-row-26">Barceló Whale Lagoon Maldives</label><label
                            for="project-27" class="project-row project-row-27">NH Kuda Rah Resort</label>
                    </section>
                    <section class="border-b border-[#dfe2e7] py-4 last:border-0">
                        <h3 class="mb-2 text-[11px] font-bold uppercase tracking-[1px] text-[#9198a1]">Vaavu Atoll
                        </h3><label for="project-28" class="project-row project-row-28">Kunaavashi Resort</label>
                    </section>
                    <section class="border-b border-[#dfe2e7] py-4 last:border-0">
                        <h3 class="mb-2 text-[11px] font-bold uppercase tracking-[1px] text-[#9198a1]">Dhaalu Atoll
                        </h3><label for="project-29" class="project-row project-row-29">Baglioni Resort</label>
                    </section>
                    <section class="border-b border-[#dfe2e7] py-4 last:border-0">
                        <h3 class="mb-2 text-[11px] font-bold uppercase tracking-[1px] text-[#9198a1]">Laamu Atoll
                        </h3><label for="project-30" class="project-row project-row-30">Six Senses Maldives
                            Resort</label>
                    </section>
                    <section class="border-b border-[#dfe2e7] py-4 last:border-0">
                        <h3 class="mb-2 text-[11px] font-bold uppercase tracking-[1px] text-[#9198a1]">Gaafu Alifu
                            Atoll</h3><label for="project-31" class="project-row project-row-31">Robinson Maldives
                            Resort</label>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <section class="container pb-[120px]">
        <p class="eyebrow"><span></span>OUR CLIENTS</p>
        <h2>Our satisfied clients.</h2>
        <p class="section-intro">Leading resorts, hotels, banks and institutions across the Maldives trust GAGE with
            their protection.</p>
        <div class="mt-12 grid grid-cols-2 gap-5 sm:grid-cols-3 lg:grid-cols-6" aria-label="Client logos">
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-3.png" alt="Vakkaru Maldives"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-74.png" alt="Finolhu Villas"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-2.jpg" alt="Fari Campus"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-78.png" alt="NOOE Maldives"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-4.jpg" alt="Outrigger"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-6.jpg" alt="Meliá Whale Lagoon"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-7.png" alt="JA Manafaru"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-79.png" alt="Cinnamon Velifushi"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-67.jpg" alt="W Maldives"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-5.jpg" alt="Club Med Kani"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-10.png" alt="La Vie"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-8.jpg" alt="You & Me Maldives"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-9.png" alt="Maxx Royal"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-11.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-56.png" alt="Baglioni"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-47.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-13.jpg" alt="Robinson"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-14.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-15.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-16.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-17.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-19.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-45.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-20.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-21.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-22.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-24.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-25.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-26.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-18.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-27.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-28.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-75.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-23.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-34.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-48.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-76.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-30.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-31.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-29.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-32.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-33.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-35.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-36.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-37.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-38.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-39.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-40.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-1.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-12.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-41.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-0.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-42.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-43.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-44.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-46.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-64.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-65.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-66.png" alt="DBM"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-68.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-69.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-70.png" alt="Ooredoo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-71.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-50.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-72.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-63.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-62.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-77.jpg" alt="Maldives Islamic Bank"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-61.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-60.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-59.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-58.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-57.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-55.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-54.jpg" alt="MCB"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-53.jpg" alt="Habib Bank"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-52.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-73.jpg" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-49.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <div class="flex h-[88px] items-center justify-center rounded-xl border border-[#dfe2e7] bg-white px-5 py-3">
                <img src="./public/assets/projects-page-51.png" alt="GAGE client logo"
                    class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
        </div>
        <div
            class="mt-[120px] flex flex-col justify-between gap-9 rounded-[24px] bg-black px-9 py-16 text-white lg:flex-row lg:items-center lg:px-16">
            <div>
                <h2 class="!mt-0">Your property could be next.</h2>
                <p class="mt-5 max-w-[740px] text-base leading-7 text-white/70">Tell us what you need to protect.
                    Our team will recommend the right mix of security,<br class="hidden xl:block"> fire safety,
                    training and technology — and give you a clear proposal.</p>
            </div>
            <div class="flex flex-col gap-3 lg:min-w-[320px]"><a href="./conact.html#enquiry"
                    class="button button-light">Get Protected Now<svg width="17" height="17" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a><a href="tel:+9603304055" class="button button-outline">Call +960 330 4055<svg
                        width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" aria-hidden="true">
                        <path d="M5 12h14m-6-6 6 6-6 6" />
                    </svg></a></div>
        </div>
    </section>
@endsection

