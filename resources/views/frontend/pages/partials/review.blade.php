  <!-- Reviews Data -->
      @php
    $reviews = [
        [
            'name' => 'Sarah Mitchell',
            'designation' => 'Retail Supervisor',
            'image' => 'teacher__1.jpg',
            'rating' => 5,
            'text' => 'Completed the Certificate IV in Retail Management with Specter Training and it really improved my leadership and customer service skills. The trainers explained everything clearly and the assessments were practical for real workplace situations.',
        ],
        [
            'name' => 'Rajiv Sharma',
            'designation' => 'Store Manager',
            'image' => 'teacher__2.jpg',
            'rating' => 4,
            'text' => 'I enrolled in the Certificate III in Retail and gained valuable knowledge about stock control, customer engagement, and sales operations. Great support from the trainers throughout the course.',
        ],
        [
            'name' => 'Pema Dorji',
            'designation' => 'Hospitality Team Leader',
            'image' => 'teacher__3.jpg',
            'rating' => 5,
            'text' => 'The Certificate IV in Hospitality helped me build confidence in managing teams and handling daily hospitality operations. Highly recommended for anyone already working in hotels or restaurants.',
        ],
        [
            'name' => 'Anjali Nair',
            'designation' => 'Administrative Assistant',
            'image' => 'teacher__4.jpg',
            'rating' => 4,
            'text' => 'I recently completed the Certificate III in Business through Specter Training. The course content was easy to follow and very relevant to office administration roles.',
        ],
        [
            'name' => 'Jone Vakacegu',
            'designation' => 'Retail Assistant',
            'image' => 'teacher__1.jpg',
            'rating' => 3,
            'text' => 'The Certificate II in Retail gave me a strong understanding of customer service and workplace communication. The trainers were very supportive and patient.',
        ],
        [
            'name' => 'Emily Rogers',
            'designation' => 'Café Supervisor',
            'image' => 'teacher__2.jpg',
            'rating' => 5,
            'text' => 'I completed the Certificate III in Hospitality and really enjoyed the learning experience. The practical examples and flexible study options made it easy to balance work and study.',
        ],
        [
            'name' => 'Tashi Wangchuk',
            'designation' => 'Front Office Staff',
            'image' => 'teacher__3.jpg',
            'rating' => 4,
            'text' => 'The Certificate II in Hospitality was perfect for starting my hospitality career. I learned valuable customer service and workplace skills that helped me secure a better position.',
        ],
        [
            'name' => 'Harpreet Singh',
            'designation' => 'Production Operator',
            'image' => 'teacher__4.jpg',
            'rating' => 5,
            'text' => 'The Certificate III in Process Manufacturing gave me hands-on knowledge about workplace safety, machinery processes, and production systems. Excellent trainers and support team.',
        ],
        [
            'name' => 'Olivia Bennett',
            'designation' => 'Office Coordinator',
            'image' => 'teacher__1.jpg',
            'rating' => 4,
            'text' => 'I studied the Certificate IV in Business and found the course very professional and industry-focused. It improved my communication and administration skills significantly.',
        ],
        [
            'name' => 'Rakesh Patel',
            'designation' => 'Sales Consultant',
            'image' => 'teacher__2.jpg',
            'rating' => 5,
            'text' => 'The Certificate III in Retail was very practical and helped me improve my sales techniques and customer interaction skills. I would definitely recommend Specter Training.',
        ],
        [
            'name' => 'Sonam Choden',
            'designation' => 'Restaurant Host',
            'image' => 'teacher__3.jpg',
            'rating' => 4,
            'text' => 'I completed the Certificate III in Hospitality and really appreciated the flexibility of the training. The trainers were experienced and always ready to help.',
        ],
        [
            'name' => 'Daniel Carter',
            'designation' => 'Business Support Officer',
            'image' => 'teacher__4.jpg',
            'rating' => 3,
            'text' => 'The Certificate III in Business helped me understand workplace systems, communication, and business operations much better. Great learning environment.',
        ],
        [
            'name' => 'Priya Menon',
            'designation' => 'Retail Team Member',
            'image' => 'teacher__1.jpg',
            'rating' => 5,
            'text' => 'I enrolled in the Certificate II in Retail and learned a lot about customer service, teamwork, and workplace procedures. Very supportive trainers and smooth enrolment process.',
        ],
        [
            'name' => 'Lobsang Tenzin',
            'designation' => 'Hotel Receptionist',
            'image' => 'teacher__2.jpg',
            'rating' => 4,
            'text' => 'The Certificate IV in Hospitality provided excellent industry knowledge and management skills. The course structure was very practical and easy to understand.',
        ],
        [
            'name' => 'Sera Raiwalui',
            'designation' => 'Customer Service Assistant',
            'image' => 'teacher__3.jpg',
            'rating' => 5,
            'text' => 'The Certificate III in Business helped me improve my office and communication skills. The trainers explained everything clearly and professionally.',
        ],
        [
            'name' => 'Matthew Collins',
            'designation' => 'Shift Supervisor',
            'image' => 'teacher__4.jpg',
            'rating' => 4,
            'text' => 'Completing the Certificate IV in Retail Management gave me confidence in leading teams and handling retail operations efficiently. Highly valuable course.',
        ],
        [
            'name' => 'Neha Kapoor',
            'designation' => 'Administration Officer',
            'image' => 'teacher__1.jpg',
            'rating' => 5,
            'text' => 'I had a wonderful experience studying the Certificate IV in Business. The learning materials were detailed and very relevant to real workplace tasks.',
        ],
        [
            'name' => 'Karma Tshering',
            'designation' => 'Café Attendant',
            'image' => 'teacher__2.jpg',
            'rating' => 3,
            'text' => 'The Certificate II in Hospitality was a great starting point for my hospitality career. I learned customer service skills that I now use every day at work.',
        ],
        [
            'name' => 'Amit Verma',
            'designation' => 'Warehouse & Retail Staff',
            'image' => 'teacher__3.jpg',
            'rating' => 4,
            'text' => 'The Certificate III in Retail improved my understanding of retail operations and customer handling. The flexible study mode was very convenient for working professionals.',
        ],
        [
            'name' => 'Sophia Williams',
            'designation' => 'Executive Assistant',
            'image' => 'teacher__4.jpg',
            'rating' => 5,
            'text' => 'I completed the Certificate III in Business with Specter Training and found the course highly beneficial for improving my administration and workplace communication skills.',
        ],
    ];
@endphp

            <!-- Slider -->
            <div class="relative">
                <div class="swiper student-stories-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($reviews as $review)
                            <div class="swiper-slide h-auto">
                                <div
                                    class="bg-white rounded-md border border-slate-200 shadow-sm 
                      p-5 sm:p-6 lg:p-7 
                      flex flex-col h-full">

                                    <!-- Stars -->
                                    <div class="flex items-center gap-1 mb-4">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review['rating'])
                                                <span class="text-brand-600 text-sm sm:text-xl">★</span>
                                            @else
                                                <span class="text-brand-600 text-sm sm:text-xl">☆</span>
                                            @endif
                                        @endfor
                                    </div>

                                    <!-- Text -->
                                    <p
                                        class="text-gray-600 text-sm sm:text-base leading-relaxed mb-6 flex-grow line-clamp-2">
                                        {{ $review['text'] }}
                                    </p>

                                    <!-- Author -->
                                    <div class="flex items-center justify-between mt-auto">

                                        <div class="flex items-center gap-3">
                                            <img src="{{ asset('frontend-img/' . $review['image']) }}"
                                                alt="{{ $review['name'] }}"
                                                class="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover">

                                            <div>
                                                <h5
                                                    class="font-semibold text-gray-900 
                             text-sm sm:text-base">
                                                    {{ $review['name'] }}
                                                </h5>
                                                <span class="text-gray-500 text-xs sm:text-sm">
                                                    {{ $review['designation'] }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>