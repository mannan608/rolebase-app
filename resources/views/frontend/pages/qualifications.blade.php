@extends('frontend.layouts.app')


@php
    $industryLevels = collect($courses)
        ->groupBy('industry')
        ->map(function ($items) {
            return collect($items)->pluck('level')->unique()->values();
        });
@endphp

@section('content')
    <section class="py-0 md:py-8 lg:py-12">
        <div class="max-w-7xl mx-auto px-5 md:px-8">
            <h1 class="lg:text-4xl md:text-3xl text-2xl font-bold text-slate-900 mb-3">Qualifications Catalog</h1>
            <p class="font-body-md text-slate-500 leading-relaxed mb-6 w-full lg:w-1/2">Explore our nationally recognized
                training programs designed to elevate your professional trajectory and secure your future in high-growth
                industries.</p>
        </div>
    </section>

    <section class="mb-6 md:mb-10">
        <div class="max-w-7xl mx-auto px-5 md:px-8">
            <div class="border border-gray-200 p-6 bg-white rounded-md">
                <form id="qualification-filter-form" method="GET" action="{{ route('qualifications') }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search courses..."
                            class="dark:bg-dark-900 focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">


                        <div x-data="{
                            selectedIndustry: '{{ request('industry', '') }}',
                            selectedLevel: '{{ request('level', '') }}',
                        
                            industryLevels: @js($industryLevels),
                        
                            get levels() {
                                return this.selectedIndustry ?
                                    (this.industryLevels[this.selectedIndustry] || []) :
                                    [];
                            }
                        }" class="col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">

                            {{-- Industry --}}
                            <div class="relative z-20 bg-transparent">

                                <select name="industry" x-model="selectedIndustry" @change="selectedLevel = ''"
                                    class="dark:bg-dark-900 focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                                    <option value="">
                                        All Industries
                                    </option>

                                    @foreach ($industries as $industry)
                                        <option value="{{ $industry }}">
                                            {{ $industry }}
                                        </option>
                                    @endforeach

                                </select>

                                <span
                                    class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">

                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                </span>

                            </div>

                            {{-- Level --}}
                            <div class="relative z-20 bg-transparent">

                                <select name="level" x-model="selectedLevel"
                                    class="dark:bg-dark-900 focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 pr-11 text-sm text-gray-800 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90">

                                    <option value="">
                                        All Levels
                                    </option>

                                    <template x-for="level in levels" :key="level">

                                        <option :value="level" x-text="level">
                                        </option>

                                    </template>

                                </select>

                                <span
                                    class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-700 dark:text-gray-400">

                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                </span>

                            </div>

                        </div>
                    </div>
                    <div class="flex items-center justify-end gap-4 mt-4">
                        <a id="clear-qualification-filter" href="{{ route('qualifications') }}"
                            class="{{ request()->filled('search') || request()->filled('industry') || request()->filled('level') ? '' : 'hidden' }} bg-brand-600 text-white rounded px-2 lg:px-4 py-2 font-medium text-sm active:scale-95 transition-transform mt-4">
                            Clear Filter
                        </a>
                    </div>

                </form>
            </div>

            <div id="qualification-results"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 md:gap-6 gap-4 mt-6 md:mt-8 transition-opacity duration-200"
                aria-live="polite">
                @include('frontend.pages.partials.qualification-cards', ['courses' => $courses])
            </div>
        </div>
    </section>
    @include('frontend.pages.partials.eligibility-form')

    <section class="bg-gray-50 py-10 sm:py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-5 md:px-8">
            <!-- Heading -->
            <div class="text-center md:mb-8 mb-4">
                <h2 class="font-display font-bold text-lg md:text-2xl lg:text-3xl text-primary mb-3">Our Student Stories
                </h2>
                <p class="text-brand-500-variant max-w-xl mx-auto text-sm md:text-base">Hear from our students
                    about their journey and success stories.</p>
            </div>
             @include('frontend.pages.partials.review')
        </div>
    </section>
@endsection

@push('scripts')
   <script>
    document.addEventListener('DOMContentLoaded', () => {

        const form = document.querySelector('#qualification-filter-form');
        const results = document.querySelector('#qualification-results');
        const clearFilter = document.querySelector('#clear-qualification-filter');

        if (!form || !results) {
            return;
        }

        let debounceTimer;
        let activeController;

        // =========================
        // MODAL LOGIC
        // =========================

        const initializeModals = () => {

            // OPEN MODAL
            document.querySelectorAll('.open-modal-btn').forEach((button) => {

                button.onclick = function () {

                    const modalId = this.dataset.modalTarget;
                    const modal = document.getElementById(modalId);

                    if (modal) {

                        modal.classList.remove('hidden');
                        modal.classList.add('flex');

                        document.body.classList.add('overflow-hidden');

                    }

                };

            });

            // CLOSE BUTTON
            document.querySelectorAll('.close-modal').forEach((button) => {

                button.onclick = function () {

                    const modal = this.closest('[id^="modal-"]');

                    if (modal) {

                        modal.classList.add('hidden');
                        modal.classList.remove('flex');

                        document.body.classList.remove('overflow-hidden');

                    }

                };

            });

            // OUTSIDE CLICK
            document.querySelectorAll('[id^="modal-"]').forEach((modal) => {

                modal.onclick = function (e) {

                    if (e.target === modal) {

                        modal.classList.add('hidden');
                        modal.classList.remove('flex');

                        document.body.classList.remove('overflow-hidden');

                    }

                };

            });

        };

        // Initial Modal Init
        initializeModals();

        // ESC CLOSE
        document.addEventListener('keydown', function (e) {

            if (e.key === 'Escape') {

                document.querySelectorAll('[id^="modal-"]').forEach((modal) => {

                    if (modal.classList.contains('flex')) {

                        modal.classList.add('hidden');
                        modal.classList.remove('flex');

                    }

                });

                document.body.classList.remove('overflow-hidden');

            }

        });

        // =========================
        // FILTER LOGIC
        // =========================

        const hasActiveFilters = () =>
            Array.from(new FormData(form).values())
            .some((value) => value.trim() !== '');

        const toggleClearFilter = () => {

            clearFilter?.classList.toggle(
                'hidden',
                !hasActiveFilters()
            );

        };

        const updateResults = () => {

            const formData = new FormData(form);
            const params = new URLSearchParams();

            formData.forEach((value, key) => {

                const normalizedValue = value.trim();

                if (normalizedValue) {
                    params.set(key, normalizedValue);
                }

            });

            const url =
                `${form.action}${params.toString() ? `?${params.toString()}` : ''}`;

            toggleClearFilter();

            if (activeController) {
                activeController.abort();
            }

            activeController = new AbortController();

            results.classList.add('opacity-50');

            fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    signal: activeController.signal,
                })
                .then((response) => {

                    if (!response.ok) {
                        throw new Error('Unable to load courses.');
                    }

                    return response.json();

                })
                .then((data) => {

                    results.innerHTML = data.html;

                    // IMPORTANT
                    initializeModals();

                    window.history.replaceState({}, '', url);

                })
                .catch((error) => {

                    if (error.name !== 'AbortError') {
                        form.submit();
                    }

                })
                .finally(() => {

                    results.classList.remove('opacity-50');

                });

        };

        form.addEventListener('submit', (event) => {

            event.preventDefault();
            updateResults();

        });

        form.querySelectorAll('select').forEach((select) => {

            select.addEventListener('change', () => {
                updateResults();
            });

        });

        form.querySelector('input[name="search"]')
            ?.addEventListener('input', () => {

                clearTimeout(debounceTimer);

                debounceTimer = setTimeout(() => {
                    updateResults();
                }, 300);

            });

        clearFilter?.addEventListener('click', (event) => {

            event.preventDefault();

            form.reset();

            document.querySelector('select[name="industry"]').value = '';
            document.querySelector('select[name="level"]').value = '';

            updateResults();

        });

    });
</script>
@endpush
