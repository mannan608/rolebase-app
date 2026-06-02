@extends('frontend.layouts.app')

@php
    use Illuminate\Support\Facades\Storage;

    $image = $blog->featured_image
        ? asset($blog->featured_image)
        : asset('images/default-blog.jpg');
@endphp

@section('content')
<section class="py-2 bg-neutral-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            {{-- Main Blog Content --}}
            <div class="lg:col-span-8">

                <article class="bg-white rounded-2xl shadow-sm border overflow-hidden blog-content">

                    {{-- Featured Image --}}
                    <img
                        src="{{ $image }}"
                        alt="{{ $blog->title }}"
                        class="w-full h-62.5 md:h-105 object-cover"
                    >

                    <div class="p-4 md:p-6 lg:p-8">

                        {{-- Meta Info --}}
                        <div class="flex flex-wrap items-center gap-2 md:gap-4 text-xs sm:text-sm text-gray-500 mb-5">
                            <span>
                                By {{ $blog->author?->name ?? 'Admin' }}
                            </span>

                            <span>
                                {{ $blog->created_at->format('d M, Y') }}
                            </span>

                            <span>
                                {{ $blog->views ?? 0 }} Views
                            </span>
                        </div>

                        {{-- Title --}}
                        <h1 class="text-2xl md:text-4xl font-bold text-gray-900 leading-tight mb-4">
                            {{ $blog->title }}
                        </h1>

                        {{-- Short Description --}}
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            {{ $blog->short_description }}
                        </p>

                        {{-- Content --}}
                        <div class="prose max-w-none blog-content">
                            {!! $blog->content !!}
                        </div>

                    </div>

                </article>

            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-4">

                <div class="sticky top-24">

                    {{-- Latest Blogs --}}
                    <div class="bg-white border rounded-2xl shadow-sm p-5">

                        <h3 class="text-xl font-bold text-gray-900 mb-5 border-b pb-3">
                            Latest Posts
                        </h3>

                        <div class="space-y-5">

                            @forelse($latestBlogs as $item)

                                @php
                                    $thumb = $item->featured_image
                                        ? asset('storage/' . $item->featured_image)
                                        : asset('images/default-blog.jpg');
                                @endphp

                                <a
                                    href="{{ route('blogs.show', $item->slug) }}"
                                    class="flex gap-4 group"
                                >

                                    <img
                                        src="{{ $thumb }}"
                                        alt="{{ $item->title }}"
                                        class="w-24 h-20 object-cover rounded-lg shrink-0"
                                    >

                                    <div>

                                        <h4 class="font-semibold text-gray-800 group-hover:text-blue-600 transition line-clamp-2">
                                            {{ $item->title }}
                                        </h4>

                                        <p class="text-sm text-gray-500 mt-2">
                                            {{ $item->created_at->format('d M, Y') }}
                                        </p>

                                    </div>

                                </a>

                            @empty

                                <p class="text-gray-500">
                                    No recent blogs found.
                                </p>

                            @endforelse

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
</section>
@endsection