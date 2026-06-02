@php
    $courseForms = [
        'certificate-iii-in-business' => 'YVAVfNk71nvX1T2IXT9O',
        'certificate-iv-in-business' => '42DfrIjt7p825OUVrWr6',
        'certificate-iii-in-process-manufacturing' => 'Fl07NcHv69HFx5Oj5xHn',
        'certificate-ii-in-retail-services' => 'km4iIpEfZrrMBnabcHGM',
        'certificate-iii-in-retail' => 'cNjSxaRVL3qF4PlV7a5U',
        'certificate-iv-in-retail-management' => 'F2hyMiRCLuetCp9uXnCD',
        'certificate-ii-in-hospitality' => 'YDsSmrKxXhpJ171svwqR',
        'certificate-iii-in-hospitality' => 'aluvYpKUihTVz99YEmOO',
        'certificate-iv-in-hospitality' => 'WJLXLqpYrV01wzI4Z6hO',
    ];
@endphp


@forelse($courses as $course)
    @php
        $formId = $courseForms[$course['slug']] ?? null;
    @endphp

    <div class="qualification-card bg-white border border-slate-200 transition-all duration-300 rounded-md">

        <div class="h-48 overflow-hidden">
            <img class="w-full h-full object-cover transition-transform duration-500 hover:scale-110"
                src="{{ asset('frontend-img/' . $course['image']) }}" alt="{{ $course['title'] }}">
        </div>

        <div class="p-6 space-y-4">

            <span class="text-caption text-xs text-[#02A8FF] bg-[#02A8FF]/10 font-semibold px-2 py-1 uppercase rounded">
                {{ $course['industry'] }}
            </span>

            <h3 class="font-semibold text-slate-900 md:text-base text-sm leading-tight mt-2">
                {{ $course['title'] }}
            </h3>

            <p class="text-slate-600 text-sm line-clamp-2">
                {{ $course['description'] }}
            </p>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-6">

              <a href="{{ route('qualifications.details', $course['slug']) }}" class="flex justify-center items-center w-1/2 bg-white border border-[#02A8FF] text-[#02A8FF] hover:bg-[#02A8FF] hover:text-white rounded py-1.5 font-medium text-sm transition-transform"> View Details </a>

                <button type="button" data-modal-target="modal-{{ $course['id'] }}"
                    class="open-modal-btn w-1/2 bg-brand-600 text-white rounded py-2 font-medium text-sm transition-transform">
                    Enroll Now
                </button>

            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div id="modal-{{ $course['id'] }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 p-4">

        <div class="bg-white rounded-xl w-full max-w-4xl relative overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between border-b px-6 py-4">
                <h3 class="text-lg font-semibold">
                    {{ $course['title'] }}
                </h3>
                <button
                    class="close-modal flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fillRule="evenodd" clipRule="evenodd"
                            d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                            fill="currentColor" />
                    </svg>
                </button>
            </div>

            {{-- Body --}}
            <div class="p-4">

                @if ($formId)
                    <iframe src="https://api.leadconnectorhq.com/widget/form/{{ $formId }}"
                        style="width:100%;height:600px;border:none;border-radius:8px" id="inline-{{ $formId }}"
                        data-layout="{'id':'INLINE'}" data-trigger-type="alwaysShow"
                        data-activation-type="alwaysActivated" data-deactivation-type="neverDeactivate"
                        data-form-id="{{ $formId }}" title="{{ $course['title'] }}">
                    </iframe>
                @else
                    <p class="text-red-500">
                        Form not available.
                    </p>
                @endif

            </div>
        </div>
    </div>

@empty

    <div class="sm:col-span-2 lg:col-span-3 rounded-md border border-dashed border-slate-300 bg-white p-8 text-center">
        <p class="text-slate-600 font-medium">No courses found.</p>
        <p class="text-slate-400 text-sm mt-1">Try another search or filter.</p>
    </div>
@endforelse


{{-- Form Script --}}
<script src="https://link.msgsndr.com/js/form_embed.js"></script>

{{-- Modal Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Open modal
        document.querySelectorAll('.open-modal-btn').forEach(button => {

            button.addEventListener('click', function() {

                const modalId = this.dataset.modalTarget;
                const modal = document.getElementById(modalId);

                modal.classList.remove('hidden');
                modal.classList.add('flex');

                document.body.classList.add('overflow-hidden');
            });
        });

        // Close modal
        document.querySelectorAll('.close-modal').forEach(button => {

            button.addEventListener('click', function() {

                const modal = this.closest('[id^="modal-"]');

                modal.classList.add('hidden');
                modal.classList.remove('flex');

                document.body.classList.remove('overflow-hidden');
            });
        });

        // Close on outside click
        document.querySelectorAll('[id^="modal-"]').forEach(modal => {

            modal.addEventListener('click', function(e) {

                if (e.target === modal) {

                    modal.classList.add('hidden');
                    modal.classList.remove('flex');

                    document.body.classList.remove('overflow-hidden');
                }
            });
        });

    });
</script>
