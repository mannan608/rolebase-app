<footer class="w-full border-t bg-slate-50 border-slate-200">

    <div
        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-12 sm:py-16">

        {{-- Column 1 --}}
        <div class="space-y-5 text-center sm:text-left">

            <div class="flex sm:justify-start items-center justify-center">
               <a href="/">
                    <img src="{{asset('logo.webp')}}" alt="logo" class="w-24 h-auto">
                </a>
            </div>

            <ul class="text-slate-500 text-sm space-y-2">

                <li class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                    <span class="font-semibold text-slate-700">Call:</span>
                    0421 661 998
                </li>

                <li class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                    <span class="font-semibold text-slate-700">Mail:</span>
                    info@spectertrainingcollege.com
                </li>

                <li class="flex flex-col sm:flex-row sm:items-baseline gap-1 sm:gap-2">
                    <span class="font-semibold text-slate-700">Address:</span>
                    PO Box 683, MOOREBANK, NSW, 1875
                </li>

            </ul>


            <div class="flex gap-3 sm:justify-start items-center justify-center">

                <!-- Facebook -->
                <a href="#"
                    class="w-9 h-9 bg-gray-50 backdrop-blur-sm rounded-xl flex items-center justify-center border border-gray-500 hover:border-gray-500 transition-all hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-5 h-5">
                        <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                    </svg>
                </a>

                <!-- Instagram -->
                <a href="#"
                    class="w-9 h-9 bg-gray-50 backdrop-blur-sm rounded-xl flex items-center justify-center border border-gray-500 hover:border-gray-500 transition-all hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-5 h-5">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                        <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                    </svg>
                </a>

                <!-- TikTok -->
                <a href="#"
                    class="w-9 h-9 bg-gray-50 backdrop-blur-sm rounded-xl flex items-center justify-center border border-gray-500 hover:border-gray-500 transition-all hover:scale-110">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-5 h-5">

                        <path d="M9 12a4 4 0 1 0 4 4V4c.5 2 2 4 5 4" />
                    </svg>
                </a>

                <!-- YouTube -->
                <a href="#"
                    class="w-9 h-9 bg-gray-50 backdrop-blur-sm rounded-xl flex items-center justify-center border border-gray-500 hover:border-gray-500 transition-all hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-5 h-5">
                        <path
                            d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 1.4-1.4 49.56 49.56 0 0 1 16.2 0A2 2 0 0 1 21.5 7a24.12 24.12 0 0 1 0 10 2 2 0 0 1-1.4 1.4 49.55 49.55 0 0 1-16.2 0A2 2 0 0 1 2.5 17">
                        </path>
                        <path d="m10 15 5-3-5-3z"></path>
                    </svg>
                </a>

                <!-- Google -->
                <a href="#"
                    class="w-9 h-9 bg-gray-50 backdrop-blur-sm rounded-xl flex items-center justify-center border border-gray-500 hover:border-gray-500 transition-all hover:scale-110">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-4.5 h-4.5">

                        <path d="M21 12.5a9 9 0 1 1-2.64-6.36" />
                        <path d="M21 12h-9" />
                    </svg>
                </a>

            </div>

        </div>


        {{-- Column 2 --}}
        <div class="space-y-5 text-center flex flex-col items-center">

            <h4 class="font-bold uppercase tracking-widest text-xs text-slate-900">
                Qualifications
            </h4>

            <ul class="space-y-2 text-sm">

                <li>
                    <a href="{{ route('qualifications') }}" class="text-slate-500 hover:text-slate-900">
                        Hospitality
                    </a>
                </li>

                <li>
                    <a href="{{ route('qualifications') }}" class="text-slate-500 hover:text-slate-900">
                        Retail
                    </a>
                </li>

                <li>
                    <a href="{{ route('qualifications') }}" class="text-slate-500 hover:text-slate-900">
                        Manufacturing
                    </a>
                </li>

                <li>
                    <a href="{{ route('qualifications') }}" class="text-slate-500 hover:text-slate-900">
                        Business
                    </a>
                </li>

            </ul>

        </div>


        {{-- Column 3 --}}
        <div class="space-y-5 text-center flex flex-col items-center">

            <h4 class="font-bold uppercase tracking-widest text-xs text-slate-900">
                Useful Links
            </h4>
          
            <ul class="space-y-2 text-sm">

                <li><a class="text-slate-500 hover:text-slate-900" href="https://www.usi.gov.au/"> Create USI</a></li>
                <li><a class="text-slate-500 hover:text-slate-900" href="https://www.checked.com.au/">Create Police Report</a></li>
                <li><a class="text-slate-500 hover:text-slate-900" href="https://www.service.nsw.gov.au/transaction/apply-for-a-working-with-children-check">Working with Children Check (WWCC)</a></li>
                <li><a class="text-slate-500 hover:text-slate-900" href="https://www.service.nsw.gov.au/services/ndiswc">NDIS Check</a></li>

            </ul>

        </div>


        {{-- Column 4 --}}
        <div class="space-y-5 text-center sm:flex sm:flex-col sm:items-end sm:text-end">

            <h4 class="font-bold uppercase tracking-widest text-xs text-slate-900">
                Accreditation
            </h4>

            <ul class="space-y-2 text-sm text-slate-500">

                <li class="mb-3">
                    <div class="flex flex-wrap justify-center items-center gap-4  transition-all duration-500">
                <img class="h-10 object-contain"
                    data-alt="clean geometric logo of a professional education authority in black and white"
                    src="{{ asset('patner_1.png') }}" alt="patner">

                <img class="h-10 object-contain" data-alt="sleek corporate mark for a global vocational training federation"
                    src="{{ asset('patner_2.png') }}" alt="patner">
            </div>
                </li>
                <li><strong>RTO No. 45116</strong></li>
                <li>ABN: 65 610 630 254</li>

            </ul>

        </div>

    </div>


    {{-- Bottom Bar --}}
    <div class="border-t border-slate-200 py-6">

        <div
            class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-center sm:text-left">

            <p class="text-slate-500 text-xs sm:text-sm">
                Copyright © 2026 All Rights Reserved SPECTER ROSS PTY LTD trading as Specter Training
            </p>

            <span class="text-slate-400 text-xs sm:text-sm">
                RTO Code: 45116
            </span>

        </div>

    </div>

</footer>
