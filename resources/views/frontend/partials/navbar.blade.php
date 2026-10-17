<nav aria-label="Main navigation" class="main-nav flex">
                <a href="{{ route('frontend.about') }}" @if(request()->routeIs('frontend.about')) aria-current="page" @endif>About</a>
                <div class="nav-dropdown">
                    <a href="{{ route('frontend.home') }}#companies">Our Companies <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down">
                            <path d="m6 9 6 6 6-6">
                            </path>
                        </svg>
                    </a>
                    <div class="dropdown-panel">
                        <a href="{{ route('frontend.gage-security') }}">GAGE Security</a>
                        <a href="{{ route('frontend.gage-fire-safety') }}">GAGE Fire Safety</a>
                        <a href="{{ route('frontend.gage-training-instruction') }}">GAGE Training Institute</a>
                        <a href="{{ route('frontend.gage-technology') }}">GAGE Technology</a>
                        <a href="https://shop.gage.com.mv">GAGE Store ↗</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <a href="{{ route('frontend.home') }}#solutions">Solutions <svg aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down">
                            <path d="m6 9 6 6 6-6">
                            </path>
                        </svg>
                    </a>
                    <div class="dropdown-panel">
                        <a href="{{ route('frontend.home') }}#solutions">Resorts &amp; Hotels</a>
                        <a href="{{ route('frontend.home') }}#solutions">Banks &amp; Diplomatic Missions</a>
                        <a href="{{ route('frontend.home') }}#solutions">Industrial, Fuel &amp; Utilities</a>
                        <a href="{{ route('frontend.home') }}#solutions">Residential &amp; Mixed-use</a>
                        <a href="{{ route('frontend.home') }}#solutions">Public Facilities</a>
                    </div>
                </div>
                <a href="{{ route('frontend.home') }}#projects">Projects &amp; Clients</a>
                <a href="{{ route('frontend.news') }}">News</a>
                <a href="mailto:info@gage.com.mv?subject=Careers%20at%20GAGE">Careers</a>
                <a href="{{ route('contact.create') }}">Contact</a>
                <a class="rounded-md bg-black px-6 py-4 text-white" href="{{ route('contact.create') }}">Get Protected Now</a>
            </nav>
