@extends('frontend.layouts.app')

@section('content')
    <section class="hero-gradient overflow-hidden -mt-10">
        <div class="max-w-7xl mx-auto px-5 lg:px-8 py-12 md:py-20 lg:py-32 grid lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-5 sm:space-y-6 lg:space-y-8 flex flex-col justify-center items-center sm:inline ">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white border border-slate-200 rounded-full">
                    <span class="w-2 h-2 rounded-full bg-brand-600 shrink-0"></span>
                    <span class="font-semibold text-caption uppercase tracking-wider text-slate-600 text-[11px] sm:text-xs">
                        Nationally Accredited Training | RTO 45116
                    </span>
                </div>
                {{-- Heading --}}
                <h1
                    class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 leading-tight max-w-2xl text-center sm:text-start">
                    Elevate Your Career with
                    <span class="text-brand-600">
                        Industry-Leading
                    </span>
                    Qualifications.
                </h1>
                {{-- Description --}}
                <p class="text-sm md:text-base lg:text-lg text-slate-600 max-w-xl leading-relaxed text-center sm:text-start">
                    Gain the skills and recognition you need to excel in today's competitive
                    job market through our specialized professional development programs.
                </p>

                {{-- CTA + Social Proof --}}
                <div class="flex flex-col sm:flex-row sm:flex-wrap sm:items-center gap-4 sm:gap-5">

                    {{-- Button --}}
                    <a href="/qualifications"
                        class="w-full sm:w-auto text-center bg-brand-600 text-white rounded-full px-6 sm:px-8 py-3 sm:py-4 font-semibold shadow-lg shadow-teal-900/20 active:scale-95 transition-all">

                        Explore All Courses

                    </a>


                    {{-- Students --}}
                    <div class="flex flex-wrap items-center gap-3">

                        {{-- Avatars --}}
                        <div class="flex -space-x-3">

                            <img class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border-2 border-white object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDG-4z1G68oQl-iGXiNYqGO3Yk26VB5WfqeAMhffyIz4YQFTWmEIRvh06FjhfKw3r6n3gmV3nkzfefju3jUrTyjy3jgvjtcnZErBZHYMlvy48LVfyZAfXNJrqkSuFDhEpeLfS3Inc19657BKI25hJJjOiRdJUzxKXuInZ8lPO43vrCfeDieCnmfHuxP6bmxZC_jvKlIvdITi0Q9aGU9DWairVcw-ujOtZNXzV-hfcO0oU3FXELuz9op6aKg4dEEfdhZMzTIRZSdzw">

                            <img class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border-2 border-white object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBHlSf5WdrLHKl1ibjPuvDYLhdzssgapeCNQhzWAs-kUqHFSJpiVBGvtG7j8XL9zRTqxkxsm5eZNrHk0_y_SMoivLMSxViylcwj354xgAvCS3EGR2_HeKsmM6lz5XLsBAWXQ8knFci4pOjpzL7MfwtK-aQjc9WSUKLg87qEWtn5PTMmN19a-QEgdZq1aPR4gLPb05gKc_CGXRrWAI0pPmHjF4J2BsBWrmE9BbDhEM_mQRTD20tbY3upRSFrc345oNFlDueGRCJEgw">

                            <img class="w-9 h-9 sm:w-10 sm:h-10 rounded-full border-2 border-white object-cover"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBDPaIO2t11KyDe5cCI6etrcRdFYBBLRBX1zVW4ks0o7i3MKBaxY6rwOrHrsg_9N2giyU4uWj1c_tBsI-jQtFbbaxvpjBzh9reL6y40xPCIuLyhVku4FyTP9ITLlWoeDWJ2cqau8NhpkuRQmhjlWrdvR9t-J1n3VxZ9KjXEfrsCWBReimdebq4E86ecGOQvXI7NHFC99EGTWKfCaBJrnoSgkaosNbe2nQO8ocumfzCk2dztTcSfoko8Y3sC3lPdhp0fph5VAXRDNg">

                        </div>


                        {{-- Text --}}
                        <span class="text-caption font-semibold text-slate-500 text-sm">
                            Joined by 2,000+ Students
                        </span>

                    </div>

                </div>

            </div>
            <!-- Conversion Form -->
            <div class="bg-white p-4 md:p-8 lg:p-10 border border-slate-200 shadow-xl relative rounded-md">
                <div class="absolute top-0 right-0 w-32 h-32 bg-brand-600/20 -z-10 translate-x-8 -translate-y-8">
                </div>
                <div class="space-y-6">
                    <h2 class="font-headline-md text-headline-md text-slate-900">Apply for Admission</h2>
                    <p class="text-slate-500 font-body-md">Fill out the form below and an education consultant will contact
                        you within 24 hours.</p>
                    @include('frontend.pages.partials.admission-form')

                </div>
            </div>
        </div>
    </section>
    <section class="bg-white py-12 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-5 md:px-8">
            <p class="text-center text-caption font-semibold text-slate-400 uppercase tracking-[0.2em] mb-8">Authorized
                Training Provider</p>
            <div class="flex flex-wrap justify-center items-center gap-12  transition-all duration-500">
                <img class="h-16 object-contain"
                    data-alt="clean geometric logo of a professional education authority in black and white"
                    src="{{ asset('patner_1.png') }}" alt="patner image">

                <img class="h-16 object-contain" data-alt="sleek corporate mark for a global vocational training federation"
                    src="{{ asset('patner_2.png') }}" alt="patner image">
            </div>
        </div>
    </section>
    <section class="py-12 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-5 md:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 md:mb-12 lg:mb-16 gap-2 lg:gap-6">
                <div class="max-w-2xl">
                    <h2 class="text-lg md:text-xl lg:text-2xl font-semibold text-slate-900 mb-4">World-Class Qualifications
                    </h2>
                    <p class="text-sm sm:text-base  text-slate-600">Our programs are designed by industry experts to
                        provide practical, immediate value to your professional career.</p>
                </div>
                <a class="text-brand-600 font-semibold text-sm sm:text-base flex items-center gap-2 group border-b border-brand-600/0 hover:border-brand-600 transition-all"
                    href="/qualifications">
                    View All Qualifications
                    <span aria-hidden="true" class="text-base">→</span>
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 md:gap-6 gap-4  mt-6 md:mt-8">
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
                <p class="text-on-surface-variant max-w-xl mx-auto text-sm md:text-base">Hear from our students
                    about their journey and success stories.</p>
            </div>
                @include('frontend.pages.partials.review')
          
        </div>
    </section>

    <section class="py-8 md:py-16 lg:py-24 ca-bg-primary relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="max-w-7xl mx-auto px-5 md:px-8 relative z-10 text-center">
            <h2 class="lg:text-4xl md:text-3xl sm:text-2xl text-xl text-white mb-6">Ready to Take the Next Step?</h2>
            <p class="md:text-lg sm:text-base text-sm text-slate-400 max-w-2xl mx-auto mb-10">Join hundreds of professionals
                who
                have advanced their careers through our accredited programs.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button type="button" data-open-apply-modal
                    class="bg-brand-600 text-white px-10 py-4 font-label-bold text-lg hover:bg-brand-600 rounded-full transition-colors">
                    Apply for Enrollment
                </button>

                <a href="{{ route('download.brochure') }}"
                    class="bg-transparent text-white border border-slate-600 px-10 py-4 font-label-bold text-lg hover:bg-white/5 rounded-full transition-colors flex items-center justify-center gap-2">
                    Download Brochure
                </a>
            </div>
        </div>
    </section>
@endsection
