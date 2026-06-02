
<div x-data="{ showModal: false }" @open-apply-modal.window="showModal = true">

<header class="fixed top-0 left-0 w-full z-50 border-b bg-white/95 backdrop-blur-md border-slate-200 shadow-sm">

    <nav class="max-w-7xl mx-auto px-5 lg:px-8">

        <div class="flex justify-between items-center h-18 md:h-20">
            <!-- Mobile Menu Button -->
            <button id="menuBtn" class="sm:hidden">

                <!-- Hamburger -->
                <svg id="menuOpenIcon" class="w-7 h-7 text-slate-800" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>

                <!-- Close -->
                <svg id="menuCloseIcon" class="hidden w-7 h-7 text-slate-800" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>

            </button>
            <!-- Logo -->
            <div class="w-20">
                <a href="/">
                    <img src="{{asset('logo.webp')}}" alt="logo" class="w-auto h-auto">
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden sm:flex items-center gap-4 md:gap-6 lg:gap-8 text-sm lg:text-base">

                {{-- Home --}}
                <a href="{{ route('home') }}"
                    class="relative font-normal transition-all duration-300
        {{ request()->routeIs('home') ? 'text-brand-600 font-normal after:w-full' : 'text-slate-700 hover:text-brand-600 after:w-0 hover:after:w-full' }}
        after:absolute after:left-0 after:bottom-[-6px]
        after:h-[2px] after:bg-brand-600 after:transition-all after:duration-300">

                    Home
                </a>


                {{-- Qualifications --}}
                <a href="{{ route('qualifications') }}"
                    class="relative font-normal transition-all duration-300
        {{ request()->routeIs('qualifications') ? 'text-brand-600 font-normal after:w-full' : 'text-slate-700 hover:text-brand-600 after:w-0 hover:after:w-full' }}
        after:absolute after:left-0 after:bottom-[-6px]
        after:h-[2px] after:bg-brand-600 after:transition-all after:duration-300">

                    Qualifications
                </a>


                {{-- About --}}
                <a href="{{ route('about') }}"
                    class="relative font-normal transition-all duration-300
        {{ request()->routeIs('about') ? 'text-brand-600 font-normal after:w-full' : 'text-slate-700 hover:text-brand-600 after:w-0 hover:after:w-full' }}
        after:absolute after:left-0 after:bottom-[-6px]
        after:h-[2px] after:bg-brand-600 after:transition-all after:duration-300">

                    About
                </a>


                {{-- Contact --}}
                <a href="{{ route('contact') }}"
                    class="relative font-normal transition-all duration-300
        {{ request()->routeIs('contact') ? 'text-brand-600 font-normal after:w-full' : 'text-slate-700 hover:text-brand-600 after:w-0 hover:after:w-full' }}
        after:absolute after:left-0 after:bottom-[-6px]
        after:h-[2px] after:bg-brand-600 after:transition-all after:duration-300">

                    Contact
                </a>

                 {{-- <a href="{{ route('blogs') }}"
                    class="relative font-normal transition-all duration-300
        {{ request()->routeIs('blogs') ? 'text-brand-600 font-normal after:w-full' : 'text-slate-700 hover:text-brand-600 after:w-0 hover:after:w-full' }}
        after:absolute after:left-0 after:bottom-[-6px]
        after:h-[2px] after:bg-brand-600 after:transition-all after:duration-300">

                    Blogs
                </a> --}}

                 {{-- <a href="{{ route('events') }}"
                    class="relative font-normal transition-all duration-300
        {{ request()->routeIs('contact') ? 'text-brand-600 font-normal after:w-full' : 'text-slate-700 hover:text-brand-600 after:w-0 hover:after:w-full' }}
        after:absolute after:left-0 after:bottom-[-6px]
        after:h-[2px] after:bg-brand-600 after:transition-all after:duration-300">

                    Events
                </a> --}}

            </div>

            <!-- Right Side -->
            <button type="button" data-open-apply-modal
                class=" text-sm lg:text-base  bg-brand-600 text-white px-4 py-2 lg:px-6 lg:py-2.5 rounded-lg font-normal hover:bg-brand-600 transition">
                Apply Now
            </button>

        </div>

    </nav>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden sm:hidden bg-white border-t border-slate-200 shadow-lg">

        <div class="flex flex-col px-6 py-5 space-y-3 text-base">
            <a href="{{ route('home') }}"
                class="{{ request()->routeIs('home') ? 'text-brand-600 font-medium' : 'text-slate-700' }}">Home</a>
            <a href="{{ route('qualifications') }}"
                class="{{ request()->routeIs('qualifications') ? 'text-brand-600 font-medium' : 'text-slate-700' }}">Qualifications</a>
            <a href="{{ route('about') }}"
                class="{{ request()->routeIs('about') ? 'text-brand-600 font-medium' : 'text-slate-700' }}">About</a>
            <a href="{{ route('contact') }}"
                class="{{ request()->routeIs('contact') ? 'text-brand-600 font-medium' : 'text-slate-700' }}">Contact</a>
                {{-- <a href="{{ route('contact') }}"
                class="{{ request()->routeIs('blogs') ? 'text-brand-600 font-medium' : 'text-slate-700' }}">Blogs</a> --}}
            <button type="button" data-open-apply-modal class="bg-brand-600 text-white py-3 rounded-lg font-normal">
                Apply Now
            </button>
        </div>
    </div>
</header>

 <x-ui.modal x-model="showModal" class="max-w-2xl p-6">
            @include('frontend.pages.partials.apply-form-modal')
        </x-ui.modal>
</div>


<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    const openIcon = document.getElementById('menuOpenIcon');
    const closeIcon = document.getElementById('menuCloseIcon');

    menuBtn.addEventListener('click', () => {

        mobileMenu.classList.toggle('hidden');

        if (mobileMenu.classList.contains('hidden')) {
            openIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        } else {
            openIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
        }

    });

    document.addEventListener('click', (event) => {
        const trigger = event.target.closest('[data-open-apply-modal]');

        if (!trigger) {
            return;
        }

        event.preventDefault();
        window.dispatchEvent(new CustomEvent('open-apply-modal'));
    });
</script>
