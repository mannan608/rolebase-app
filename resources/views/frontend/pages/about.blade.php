@extends('frontend.layouts.app')

@section('content')

    {{-- Hero Section --}}
    <section class="relative py-8 md:py-0 min-h-[420px] md:min-h-[520px] lg:min-h-[600px] flex items-center overflow-hidden -mt-4">

        <div class="absolute inset-0 z-0">
            <img
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQoY05k-jNBUO0YmxAqoLM5DGm_5330TYZTmlU5wZAkAbZJzZTBJuR8jez1K2SkYI1nH1IH9BSzC87aMBdA1eWSnwXJ8jyvpwgQ2-iyucX3phY7sQMmLA98O57-3JaWaqb0wvkYAv5sy0pwY7ssk-alxoxK7qBlP9VZuDKcxGmeTuAuVOQTUXJOmiqEJoS7bk5GATbF7uAg7y3hvRgSiRkbcK6ll9T1VpwNMrVaEpkgfMbvRb5YDMuc2K52GzVeFS3YJ8VKfagpA"
                alt="Training"
                class="w-full h-full object-cover">

            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/60 to-transparent"></div>
        </div>


        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">

            <div class="max-w-2xl">

                <h1 class="text-white font-bold text-2xl sm:text-3xl lg:text-4xl leading-tight mb-4 sm:mb-6">
                    Empowering the Next Generation of Professionals
                </h1>

                <p class="text-slate-200 text-base sm:text-lg leading-relaxed mb-6 sm:mb-8">
                    At Specter Training, we bridge the gap between academic knowledge
                    and industry demands. Our mission is to provide world-class
                    vocational education that transforms careers and fuels
                    professional growth.
                </p>


                <div class="flex flex-col sm:flex-row gap-4">

                    <a href="https://spectertrainingcollege.com/qualifications"
                        class="bg-brand-600 text-white px-6 sm:px-8 py-3 sm:py-4 rounded font-semibold">
                       Qualifications
                </a>

                </div>

            </div>

        </div>

    </section>

@endsection