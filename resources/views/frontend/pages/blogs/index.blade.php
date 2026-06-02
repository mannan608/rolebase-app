@extends('frontend.layouts.app')

@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp

@section('content')
    <section class="py-8 md:py-12">
        <div class="max-w-7xl mx-auto px-5 md:px-8">

            {{-- Blog Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @forelse ($blogs as $blog)
                    @php
                        $image = $blog->featured_image
                            ? asset($blog->featured_image)
                            : asset('images/default-blog.jpg');
                    @endphp
                    <a href="{{ route('blog-details', $blog->slug) }}">
                        <div class="bg-white border rounded-lg shadow-sm overflow-hidden">
                            <img class="w-full h-56 object-cover" src="{{ $image }}" alt="{{ $blog->title }}" />

                            {{-- Blog Content --}}
                            <div class="p-5">

                                <p class="text-sm text-gray-500 mb-2">
                                    By {{ $blog->author?->name ?? 'Admin' }}
                                </p>

                                <h2 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-1">
                                    {{ $blog->title }}
                                </h2>

                                <p class="text-gray-600 mb-4 text-sm md:text-base line-clamp-3">
                                    {{ Str::limit($blog->short_description, 120) }}
                                </p>

                            </div>
                        </div>
                    </a>

                @empty
                    <div class="col-span-full text-center py-10">
                        <p class="text-gray-500">No blogs found.</p>
                    </div>
                @endforelse

            </div>

            {{-- Pagination --}}
            @if ($blogs instanceof \Illuminate\Pagination\AbstractPaginator)
                <div class="mt-10">
                    {{ $blogs->links() }}
                </div>
            @endif

        </div>
    </section>
@endsection
