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



    {{-- About Section --}}
    <section class="py-12 sm:py-16">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center">

                {{-- Left --}}
                <div class="lg:col-span-7">

                    <span class="text-brand-600 font-semibold uppercase tracking-widest mb-3 block text-sm">
                        Established Excellence
                    </span>

                    <h2 class="font-bold text-2xl sm:text-3xl lg:text-4xl leading-tight mb-6">
                        A Legacy of Quality, A Future of Innovation
                    </h2>

                    <div class="space-y-5 text-slate-600 leading-relaxed">

                        <p>
                            Founded with a singular vision to redefine vocational training,
                            Specter Training has spent over two decades building
                            a reputation for excellence.
                        </p>

                        <p>
                            Our curriculum is developed alongside industry leaders,
                            ensuring every learner graduates with practical experience,
                            confidence, and recognized credentials.
                        </p>

                    </div>

                </div>


                {{-- Right --}}
                <div class="lg:col-span-5 relative">

                    <div class="aspect-square rounded-xl overflow-hidden shadow-xl">
                        <img
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuAB_w8cKWqrBIle4cOjX83QJWeo_ysGNlIr4DJ_8bkFaaEvk9QEvO_WGYONHEsCaT8m_p7y2F-3Bv7wBgREF_gzQ772YTAzYCcGrj2Ady4Ok35G1Kvj6N0ndY66e-mmuwxHbGMeCtj8xxF9equLu9lpAZYkL5BfTTOJdhwPy6_wxIbCTZdkgbwSvJvrXM3K5BoSqA2Pq5AlpQagyCL3NPXVqKerJxJT4m4EJgkppqkg8ZFS5alQZOug7L4T-1qMRMH1Z7P6XA9uYw"
                            alt="Workshop"
                            class="w-full h-full object-cover">
                    </div>


                    <div class="hidden md:block absolute -bottom-5 -left-5 bg-brand-600 text-white p-6 rounded-xl shadow-lg">

                        <div class="text-3xl font-bold">
                            9+
                        </div>

                        <div class="text-sm font-semibold uppercase">
                            Years of Success
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- Core Values --}}
    <section class="py-12 sm:py-16 bg-slate-50">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-10 sm:mb-14">

                <h2 class="font-bold text-2xl sm:text-3xl lg:text-4xl mb-4">
                    Core Values That Drive Us
                </h2>

                <p class="text-slate-600 max-w-2xl mx-auto">
                    Our culture is built on core principles that guide
                    every decision we make for our students.
                </p>

            </div>



            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Card 1 --}}
                <div class="bg-white p-6 sm:p-8 rounded-xl border">

                    <span class="material-symbols-outlined text-brand-600 text-4xl mb-5">
                        school
                    </span>

                    <h3 class="font-semibold text-xl sm:text-2xl mb-4">
                        Quality Education
                    </h3>

                    <p class="text-slate-600">
                        We maintain high educational standards to ensure
                        every student receives practical and relevant knowledge.
                    </p>

                </div>


                {{-- Card 2 --}}
                <div class="bg-white p-6 sm:p-8 rounded-xl border">

                    <span class="material-symbols-outlined text-brand-600 text-4xl mb-5">
                        settings_input_component
                    </span>

                    <h3 class="font-semibold text-xl sm:text-2xl mb-4">
                        Industry Relevance
                    </h3>

                    <p class="text-slate-600">
                        Our programs are aligned with real-world industry demands
                        and employer expectations.
                    </p>

                </div>


                {{-- Card 3 --}}
                <div class="bg-white p-6 sm:p-8 rounded-xl border">

                    <span class="material-symbols-outlined text-brand-600 text-4xl mb-5">
                        emoji_events
                    </span>

                    <h3 class="font-semibold text-xl sm:text-2xl mb-4">
                        Student Success
                    </h3>

                    <p class="text-slate-600">
                        We support learners from enrollment to employment
                        through expert guidance and career support.
                    </p>

                </div>

            </div>

        </div>

    </section>



    {{-- Advantage Section --}}
    <section class="py-12 sm:py-16 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

                {{-- Left --}}
                <div class="lg:col-span-4">

                    <h2 class="font-bold text-2xl sm:text-3xl lg:text-4xl mb-5">
                        The Specter Advantage
                    </h2>

                    <p class="text-slate-600 mb-6">
                        What sets us apart is our strong focus on outcomes,
                        practical learning, and industry alignment.
                    </p>


                    <div class=" p-6 rounded-xl border bg-gray-100">

                        <h4 class="font-semibold mb-2">
                            Want to know more?
                        </h4>

                        <p class="text-sm opacity-90 mb-5">
                            Download our organizational profile and course guide.
                        </p>

                        <a
                            href="{{ route('download.brochure') }}"
                            class="border border-white/40 bg-brand-600 text-white rounded py-3 flex justify-center">

                            Download Brochure

                        </a>

                    </div>

                </div>



                {{-- Right --}}
                <div class="lg:col-span-8 grid grid-cols-1 md:grid-cols-2 gap-5">

                    @php
                        $features = [
                            ['verified', 'Recognized Qualifications'],
                            ['bolt', 'Flexible Learning'],
                            ['groups', 'Expert Trainers'],
                            ['trending_up', 'Career Support'],
                        ];
                    @endphp

                    @foreach ($features as $feature)
                        <div class="border rounded-lg p-6 flex gap-4">

                            <span class="material-symbols-outlined text-brand-600">
                                {{ $feature[0] }}
                            </span>

                            <div>

                                <h4 class="font-semibold text-lg mb-2">
                                    {{ $feature[1] }}
                                </h4>

                                <p class="text-sm text-slate-600">
                                    Professional learning designed for career success.
                                </p>

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </div>

    </section>

@endsection