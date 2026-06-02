@extends('frontend.layouts.app')

@section('content')
       {{-- Hero Section --}}
    <section class="-mt-4">
        <div class="relative overflow-hidden">

            {{-- Background --}}
            <div class="absolute inset-0">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuC7DRrvrvyU6gG3zu1OoJa0eKcBclew-hkiW7KRzYWA9k11jhh5ZyY2eDs55VfW3un8abNaMpHKhtxkIhfIEprKBHJSD5rPdWzDeIIJawl6w6h6oaOZix9sHWrg3p5q_MOnGJ8LJhjQOj2EOy8H3WdOkXDkkgcCudyr1rPLrYSEOdpIyvrzLDs4FGECXeHcCdCFcB-VGsSKyzwtrMJbhYpRy-KmX6_NotI7hAvGJq2_zqGJHbBnxdJXqkR5m9rsyBGwDDv_L2KNFA"
                    alt="Hospitality" class="w-full h-full object-cover">

                <div class="absolute inset-0 bg-black/70"></div>
            </div>

            {{-- Content --}}
            <div class="relative max-w-7xl mx-auto px-5 md:px-8 py-12 sm:py-16 lg:py-24">

                {{-- Badge --}}
                <div
                    class="inline-flex items-center gap-2 bg-brand-500/10 backdrop-blur-md border border-white/20 px-3 py-2 rounded-full mb-5">

                    <span class="material-symbols-outlined text-sm text-brand-600">
                        school
                    </span>

                    <span class="text-xs font-semibold tracking-widest uppercase text-white">
                        SIT40421 Nationally Recognised
                    </span>

                </div>

                {{-- Title --}}
                <h1
                    class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-white leading-tight max-w-4xl mb-6 sm:mb-10">
                    {{ $course['title'] }}
                </h1>

            </div>

        </div>
    </section>


    {{-- Main Section --}}
    <section>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12 lg:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                <!-- Left Content Area -->
                <div class="lg:col-span-8 space-y-10 sm:space-y-14 lg:space-y-16">
                    <!-- Overview Section -->
                    <section id="overview">
                        <h2
                            class="font-headline-lg text-headline-lg text-xl sm:text-2xl lg:text-3xl mb-4 sm:mb-6 flex items-center gap-3">
                            <span class="w-8 h-1 bg-brand-500 inline-block"></span>
                            Course Overview
                        </h2>
                        <div class="prose prose-slate max-w-none">
                            <p
                                class="font-body-lg text-body-lg text-brand-500-variant text-sm sm:text-base lg:text-lg leading-relaxed">
                                The Certificate IV in Business develops advanced business administration and operational skills for individuals seeking supervisory or specialised business roles.
                            </p>
                        </div>
                    </section>
                    <!-- Curriculum Bento Grid -->
                    <section id="curriculum">
                        <h2
                            class="font-headline-lg text-headline-lg text-xl sm:text-2xl lg:text-3xl mb-5 sm:mb-8 flex items-center gap-3">
                            <span class="w-8 h-1 bg-brand-500 inline-block"></span>
                            Course Structure
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                            <!-- Core Modules -->
                            <div
                                class="bg-white border border-slate-200 p-5 sm:p-6 lg:p-8 rounded shadow-sm hover:shadow-md transition-all">
                                <span class="material-symbols-outlined text-brand-500 mb-4"
                                    style="font-size: 32px;">verified</span>
                                <h3 class="text-base md:text-lg text-headline-md  sm:text-xl mb-3 sm:mb-4">Core Modules – (What it is for)</h3>
                                <ul class="space-y-2 sm:space-y-3 font-body-md text-brand-500-variant text-sm sm:text-base">
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-xs mt-1">check_circle</span>
                                        Advanced business communication
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-xs mt-1">check_circle</span>
                                        Team leadership and coordination
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-xs mt-1">check_circle</span>
                                        Project and operational support
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-xs mt-1">check_circle</span>
                                        Business technology systems
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-xs mt-1">check_circle</span>
                                        Workplace problem-solving
                                    </li>
                                </ul>
                            </div>
                            <!-- Electives -->
                            <div class="bg-slate-50 border border-slate-200 p-5 sm:p-6 lg:p-8 rounded">
                                <span class="material-symbols-outlined text-brand-500 mb-4"
                                    style="font-size: 32px;">category</span>
                                <h3 class="text-base md:text-lg text-headline-md sm:text-xl mb-3 sm:mb-4">Elective Modules – (What it is for)
                                </h3>
                                <ul class="space-y-2 sm:space-y-3 font-body-md text-brand-500-variant text-sm sm:text-base">
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-xs mt-1">add_circle_outline</span>
                                        Human resources support
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-xs mt-1">add_circle_outline</span>
                                        Marketing coordination
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-xs mt-1">add_circle_outline</span>
                                        Financial administration
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-xs mt-1">add_circle_outline</span>
                                        Customer relationship management
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="material-symbols-outlined text-xs mt-1">add_circle_outline</span>
                                        Business project planning
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </section>
                    <!-- Outcomes Section -->
                    <section class="bg-surface-container p-0 sm:p-8 lg:p-10 rounded" id="outcomes">
                        <div class="flex flex-col md:flex-row gap-8 lg:gap-12">
                            <div class="flex-1">
                                <h2 class="font-headline-lg text-headline-lg text-xl sm:text-2xl lg:text-3xl mb-4 sm:mb-6">
                                    Career Outcomes</h2>
                                <p class="font-body-md text-brand-500-variant text-sm sm:text-base mb-4 sm:mb-6">Upon
                                    successful completion of this
                                    qualification, students are prepared for leadership roles in the global hospitality
                                    sector.</p>
                               <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                    <div class="flex items-center gap-3 bg-white p-3 sm:p-4 rounded border border-slate-200">
                                        <span class="material-symbols-outlined text-brand-500">badge</span>
                                        <span class="font-label-bold">Office Administrator</span>
                                    </div>
                                    <div class="flex items-center gap-3 bg-white p-3 sm:p-4 rounded border border-slate-200">
                                        <span class="material-symbols-outlined text-brand-500">badge</span>
                                        <span class="font-label-bold">Executive Assistant</span>
                                    </div>
                                    <div class="flex items-center gap-3 bg-white p-3 sm:p-4 rounded border border-slate-200">
                                        <span class="material-symbols-outlined text-brand-500">badge</span>
                                        <span class="font-label-bold">Business Coordinator</span>
                                    </div>
                                    <div class="flex items-center gap-3 bg-white p-3 sm:p-4 rounded border border-slate-200">
                                        <span class="material-symbols-outlined text-brand-500">badge</span>
                                        <span class="font-label-bold">Team Leader</span>
                                    </div>
                                    <div class="flex items-center gap-3 bg-white p-3 sm:p-4 rounded border border-slate-200">
                                        <span class="material-symbols-outlined text-brand-500">badge</span>
                                        <span class="font-label-bold">Project Support Officer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="md:w-1/3">
                                <img alt="Hospitality professional in action"
                                    class="rounded-lg shadow-lg w-full h-full object-cover"
                                    data-alt="professional male manager in a crisp suit standing in a modern luxury hotel lobby, blurred background, warm interior lighting"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAbBIEMlEEqMe0sC6KvqTxAyaFamqAN-mswEaNfIEQl3K30Gu_ThLpKe5HtIxY2I5w0Xm0eTBjyc1whn72mktjoT9AEbIVLyQUi2Ciubqv0hgS9Rny6Xaw1iKJ4h0EoTslKXMaYzi2HS5891hSLG_a0rVUH2FDXEIM0wtPKaYNFbammzks12W3GtTOoyRg52fol-jzsnZUuT5wLpbWmZUQep3Zql0zZHwmzez2sVjGZI1j9OFuBGlIUNY09cgX_ChNZeuCRRkxcAQ">
                            </div>
                        </div>
                    </section>
                    <!-- What You Will Develop -->
                    <section id="development">
                        <h2 class="text-lg sm:text-xl lg:text-3xl mb-4 sm:mb-6 flex items-center gap-3">
                            <span class="w-8 h-1 bg-brand-500 inline-block"></span>
                            What You Will Develop
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                            <div class="flex items-center gap-4 bg-white p-4 sm:p-5 lg:p-6 border border-slate-200 rounded">
                                <div class="w-10 h-10 rounded-full bg-brand-500/10 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-brand-500">gavel</span>
                                </div>
                                <p class="font-body-md text-brand-500 text-sm sm:text-base">Coordinate business activities effectively</p>
                            </div>

                            <div class="flex items-center gap-4 bg-white p-4 sm:p-5 lg:p-6 border border-slate-200 rounded">
                                <div class="w-10 h-10 rounded-full bg-brand-500/10 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-brand-500">gavel</span>
                                </div>
                                <p class="font-body-md text-brand-500 text-sm sm:text-base">Lead workplace teams professionally</p>
                            </div>

                            <div class="flex items-center gap-4 bg-white p-4 sm:p-5 lg:p-6 border border-slate-200 rounded">
                                <div class="w-10 h-10 rounded-full bg-brand-500/10 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-brand-500">gavel</span>
                                </div>
                                <p class="font-body-md text-brand-500 text-sm sm:text-base">Prepare reports and documentation</p>
                            </div>

                            <div class="flex items-center gap-4 bg-white p-4 sm:p-5 lg:p-6 border border-slate-200 rounded">
                                <div class="w-10 h-10 rounded-full bg-brand-500/10 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-brand-500">gavel</span>
                                    </div>
                                <p class="font-body-md text-brand-500 text-sm sm:text-base">Support business projects and operations</p>
                            </div>

                            <div class="flex items-center gap-4 bg-white p-4 sm:p-5 lg:p-6 border border-slate-200 rounded">
                                <div class="w-10 h-10 rounded-full bg-brand-500/10 flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-brand-500">gavel</span>
                                </div>
                                <p class="font-body-md text-brand-500 text-sm sm:text-base">Use advanced business technologies</p>
                            </div>
                        </div>
                    </section>
                    <!-- Industries That Value This Qualification -->
                    <section id="industries">
                        <h2 class="text-lg sm:text-xl lg:text-3xl mb-4 sm:mb-6 flex items-center gap-3">
                            <span class="w-8 h-1 bg-brand-500 inline-block"></span>
                            Industries That Value This Qualification
                        </h2>
                        <div class="flex flex-wrap gap-2 sm:gap-3">
                            <span
                                class="bg-brand-500/10 px-4 sm:px-6 py-2 sm:py-3 rounded-full font-label-bold text-brand-500 flex items-center gap-2 text-sm">
                                 Corporate Businesses
                            </span>
                            <span
                                class="bg-brand-500/10 px-4 sm:px-6 py-2 sm:py-3 rounded-full font-label-bold text-brand-500 flex items-center gap-2 text-sm">
                                 Healthcare Administration
                            </span>
                            <span
                                class="bg-brand-500/10 px-4 sm:px-6 py-2 sm:py-3 rounded-full font-label-bold text-brand-500 flex items-center gap-2 text-sm">
                                 Government Departments
                            </span>
                            <span
                                class="bg-brand-500/10 px-4 sm:px-6 py-2 sm:py-3 rounded-full font-label-bold text-brand-500 flex items-center gap-2 text-sm">
                                Education Providers
                            </span>
                            <span
                                class="bg-brand-500/10 px-4 sm:px-6 py-2 sm:py-3 rounded-full font-label-bold text-brand-500 flex items-center gap-2 text-sm">
                                 Financial Services
                            </span>
                        </div>
                    </section>
                    <!-- Study Pathways -->
                    <section id="pathways">
                        <h2 class="text-lg sm:text-xl lg:text-3xl mb-4 sm:mb-6 flex items-center gap-3">
                            <span class="w-8 h-1 bg-brand-500 inline-block"></span>
                            Study Pathways
                        </h2>
                        <div class="space-y-3 sm:space-y-4">
                            <div
                                class="bg-white border-l-4 border-brand-500 p-4 sm:p-5 lg:p-6 shadow-sm rounded-r flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-6">
                                <div class="flex items-center gap-3 sm:gap-4">
                                    <span class="material-symbols-outlined text-brand-500">arrow_forward</span>
                                    <span class="text-base md:text-lg text-headline-md">Diploma of Business</span>
                                </div>
                                <span class="text-caption font-caption bg-slate-100 px-3 py-1 rounded w-fit">Next
                                    Level</span>
                            </div>
                            <div
                                class="bg-white border-l-4 border-brand-500 p-4 sm:p-5 lg:p-6 shadow-sm rounded-r flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-6">
                                <div class="flex items-center gap-3 sm:gap-4">
                                    <span class="material-symbols-outlined text-brand-500">arrow_forward</span>
                                    <span class="text-base md:text-lg text-headline-md">Diploma of Leadership and Management</span>
                                </div>
                                <span class="text-caption font-caption bg-slate-100 px-3 py-1 rounded w-fit">Advanced
                                    Level</span>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Right Sticky Sidebar -->
                <aside class="lg:col-span-4">
                    <div class="sticky-sidebar sticky space-y-6">
                        <!-- Quick Apply Form -->
                        <div
                            class="bg-white border border-slate-200 px-2 rounded-lg shadow-sm  overflow-hidden relative">
                            <div class="px-4 py-5">
                                <h3 class="text-base md:text-lg font-bold  mb-1.5 sm:mb-2">Quick Apply</h3>
                                <p class="text-base md:text-lg text-brand-500"> {{ $course['title'] }}</p>
                            </div>
                         <x-course-apply-form :slug="$course['slug']" />
                            <!-- Enrollment Deadline -->
                        </div>
                        <!-- Secondary Actions -->
                        <div class="grid grid-cols-1 gap-4">
                         <a href="{{ route('download.brochure') }}"
                                class="flex items-center justify-center gap-3 w-full border border-primary-container text-primary-container py-3 rounded font-label-bold text-sm hover:bg-slate-50 transition-colors">
                                <span class="material-symbols-outlined text-sm">download</span>
                                Download Brochure
                        </a>
                            <a href="mailto:enquiry@spectertrainingcollege.com"
                                class="flex items-center justify-center gap-3 w-full bg-slate-100 text-brand-500-variant py-3 rounded font-label-bold text-sm hover:bg-slate-200 transition-colors">

                                <span class="material-symbols-outlined text-sm">mail</span>
                                Enquire via Email
                            </a>
                        </div>
                        <div class="mt-8 sm:mt-10 lg:mt-12 pt-8 sm:pt-10 lg:pt-12 border-t border-slate-100 space-y-8">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="w-8 h-1 bg-brand-500 inline-block"></span>
                                <h4 class="font-label-bold text-brand-500-variant uppercase tracking-[0.2em] text-xs">
                                    Related Courses</h4>
                            </div>
                             <div class="grid grid-cols-1 gap-6">                             
                                @include('frontend.pages.partials.qualification-cards', [
                                    'courses' => $courses,
                                ])
                            </div>
                        </div>
                    </div>
                </aside>
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
@endsection
