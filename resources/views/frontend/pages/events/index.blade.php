@extends('frontend.layouts.app')

@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp

@section('content')
    <section class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-5 md:px-8">

            {{-- event Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse ($events as $event)
                    @php
                        $image = $event->banner
                            ? asset($event->banner)
                            : asset('images/default-event.jpg');
                    @endphp
                    <a href="{{ route('event-details', $event->slug) }}">
                        <div class="bg-white border rounded-lg shadow-sm overflow-hidden">
                            <img class="w-full h-56 object-cover" src="{{ $image }}" alt="{{ $event->title }}" />

                            {{-- event Content --}}
                            <div class="p-5">

                                <p class="text-sm text-gray-500 mb-2">
                                    By {{ $event->author?->name ?? 'Admin' }}
                                </p>

                                <h2 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-1">
                                    {{ $event->title }}
                                </h2>

                                <p class="text-gray-600 mb-4 text-sm md:text-base line-clamp-3">
                                    {{ Str::limit($event->short_description, 120) }}
                                </p>

                            </div>
                        </div>
                    </a>

                @empty
                    <div class="col-span-full text-center py-10">
                        <p class="text-gray-500">No events found.</p>
                    </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            @if ($events instanceof \Illuminate\Pagination\AbstractPaginator)
                <div class="mt-10">
                    {{ $events->links() }}
                </div>
            @endif

        </div>
    </section>
@endsection
