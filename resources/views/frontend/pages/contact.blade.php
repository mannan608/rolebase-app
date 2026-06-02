@extends('frontend.layouts.app')

@section('content')
<!-- Breadcrumb -->
<section class="relative bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('frontend-img/breadcrumb.jpg') }}')">

    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative max-w-7xl mx-auto px-5 md:px-8 py-16 sm:py-20 lg:py-28">
        
       <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white text-center">
            Contact Us
        </h1>

    </div>
</section>



<!-- Contact Info -->
<section class="py-14 sm:py-20 lg:py-24 bg-white">

    <div class="max-w-7xl mx-auto px-5 md:px-8">

        <!-- Heading -->
        <div class="text-center mb-10 sm:mb-14">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900">
                General Contact Information
            </h2>
        </div>


        <!-- Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-8">

            <!-- Address -->
            <div class="bg-gray-50 rounded-2xl p-6 sm:p-8 shadow-sm border">
                
                <div class="mb-5">
                    <svg class="w-8 h-8 text-gray-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 11.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                        <path d="M12 21s8-4.5 8-10.5S15.314 3 12 3 4 6.5 4 10.5 12 21 12 21z"/>
                    </svg>
                </div>

                <p class="text-gray-700 text-sm sm:text-base leading-7">
                    PO Box 683, MOOREBANK, NSW, 1875 
                </p>

            </div>



            <!-- Phone -->
            <div class="bg-gray-50 rounded-2xl p-6 sm:p-8 shadow-sm border">
                
                <div class="mb-5">
                    <svg class="w-8 h-8 text-gray-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                </div>

                <a href="tel:0479110567"
                    class="text-gray-700 text-sm sm:text-base hover:text-blue-600 transition">
                   0421 661 998
                </a>

            </div>



            <!-- Office Time -->
            <div class="bg-gray-50 rounded-2xl p-6 sm:p-8 shadow-sm border">
                
                <div class="mb-5">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 6V12L16 14" stroke="currentColor" stroke-width="2"/>
                    </svg>
                </div>

                <p class="text-gray-700 text-sm sm:text-base leading-7">
                    Mon-Fri: 9 AM – 6 PM <br>
                    Saturday: 9 AM – 4 PM
                </p>

            </div>

        </div>

    </div>

</section>



<!-- Map Section -->
<section class="pb-14 sm:pb-20 lg:pb-24 bg-white">

    <div class="max-w-7xl mx-auto px-5 md:px-8">

        <!-- Heading -->
        <div class="text-center mb-8 sm:mb-12">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900">
                Other Campus Contacts
            </h2>
        </div>


        <!-- Map -->
        <div class="rounded-2xl overflow-hidden shadow-md border">

           <iframe
    class="w-full h-[300px] sm:h-[400px] lg:h-[500px]"
    src="https://maps.google.com/maps?q=PO%20Box%20683,%20MOOREBANK,%20NSW,%201875&t=&z=13&ie=UTF8&iwloc=&output=embed"
    loading="lazy">
</iframe>

        </div>

    </div>

</section>
@endsection