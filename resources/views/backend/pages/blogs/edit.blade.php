@extends('backend.layouts.app')

@php
    $seo = $seo ?? null;
@endphp

@section('content')
    <form action="{{ role_route('role.blogs.update', ['blog' => $blog]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

            <div class="lg:col-span-8 space-y-6">

                {{-- Blog Content --}}
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">

                    <div class="border-b border-gray-100 p-5 dark:border-gray-800">

                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                            Blog Content
                        </h2>

                    </div>

                    <div class="p-5 space-y-5">

                        {{-- Title --}}
                        <x-form.input-text name="title" label="Blog Title" value="{{ old('title', $blog->title ?? '') }}"
                            placeholder="Enter blog title..." />

                        {{-- Short Description --}}
                        <x-form.textarea-input name="short_description" label="Short Description" rows="3"
                            placeholder="Enter short description..." :value="$blog->short_description ?? ''" />

                        {{-- Editor --}}
                        <div>

                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">

                                Blog Content

                            </label>

                            @include('backend.pages.blogs.text-editor')

                        </div>

                    </div>

                </div>

            </div>


            <div class="lg:col-span-4">

                <div class="sticky top-6 space-y-6">

                    {{-- Publish --}}
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">

                        <div class="border-b border-gray-100 p-5 dark:border-gray-800">

                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Publish
                            </h2>

                        </div>

                        <div class="space-y-5 p-5">

                            {{-- Status --}}
                            <x-form.select-input name="status" label="Status" :options="[
                                'draft' => 'Draft',
                                'published' => 'Published',
                            ]"
                                value="{{ old('status', $blog->status ?? 'draft') }}" />

                            {{-- Featured --}}
                            <div>

                                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">

                                    Featured Blog

                                </label>

                                <label class="inline-flex items-center gap-3">

                                    <input type="checkbox" name="is_featured" value="1"
                                        {{ old('is_featured', $blog->is_featured ?? false) ? 'checked' : '' }}
                                        class="h-5 w-5 rounded border-gray-300 text-brand-600 focus:ring-brand-500">

                                    <span class="text-sm text-gray-600 dark:text-gray-400">
                                        Mark as featured
                                    </span>

                                </label>

                            </div>

                            {{-- Submit --}}
                            <button type="submit"
                                class="w-full rounded-xl bg-brand-600 px-5 py-3 text-sm font-medium text-white transition hover:bg-brand-700">

                                Update Blog

                            </button>

                        </div>

                    </div>

                    {{-- Featured Image --}}
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">

                        <div class="border-b border-gray-100 p-5 dark:border-gray-800">

                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Featured Image
                            </h2>

                        </div>

                        <div class="p-5">
                            @if (!empty($blog?->featured_image))
                                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($blog->featured_image) }}"
                                    class="mb-4 w-full rounded-xl border border-gray-200 object-cover" alt="feature image">
                            @endif

                            <x-form.dropzone name="featured_image" label="Featured Image" value=""
                                placeholder="Upload featured image..." />

                        </div>

                    </div>

                    {{-- SEO --}}
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">

                        <div class="border-b border-gray-100 p-5 dark:border-gray-800">

                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                                SEO Settings
                            </h2>

                        </div>

                        <div class="space-y-4 p-5">

                            <x-form.input-text name="meta_title" label="Meta Title"
                                value="{{ old('meta_title', $seo?->meta_title ?? '') }}" placeholder="Meta title..." />

                            <x-form.textarea-input name="meta_description" label="Meta Description" rows="3"
                                placeholder="Meta description..." :value="old('meta_description', $seo?->meta_description ?? '')" />

                            <x-form.textarea-input name="meta_keywords" label="Meta Keywords" rows="2"
                                placeholder="keyword1, keyword2" :value="old('meta_keywords', $seo?->meta_keywords ?? '')" />

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </form>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            initializeDynamicFields('header-scripts-wrapper', 'header_scripts[]', 'Header Scripts');
            initializeDynamicFields('footer-scripts-wrapper', 'footer_scripts[]', 'Footer Scripts');

            function initializeDynamicFields(wrapperId, inputName, labelText) {
                const wrapper = document.getElementById(wrapperId);

                if (!wrapper) {
                    return;
                }

                updateButtons(wrapper);

                wrapper.addEventListener('click', function(e) {

                    /*
                    |--------------------------------------------------------------------------
                    | Add New
                    |--------------------------------------------------------------------------
                    */
                    if (e.target.classList.contains('add-btn')) {

                        const div = document.createElement('div');

                        div.classList.add('script-row', 'space-y-3', 'mb-4');

                        div.innerHTML = `
                    <textarea
                        name="${inputName}"
                        rows="4"
                        placeholder="Enter scripts..."
                        class="dark:bg-dark-900
                shadow-theme-xs
                focus:border-brand-300
                focus:ring-brand-500/10
                dark:focus:border-brand-800
                w-full
                rounded-lg
                border
                border-gray-300
                bg-transparent
                px-4
                py-2.5
                text-sm
                text-gray-800
                placeholder:text-gray-400
                focus:ring-3
                focus:outline-hidden
                dark:border-gray-700
                dark:bg-gray-900
                dark:text-white/90
                dark:placeholder:text-white/30"
                    ></textarea>

                    <div class="flex justify-end gap-3">

                        <button
                            type="button"
                            class="remove-btn text-sm bg-red-500 py-1.5 px-4 rounded text-white"
                        >
                            Remove
                        </button>

                        <button
                            type="button"
                            class="add-btn text-sm bg-brand-600 py-1.5 px-4 rounded text-white"
                        >
                            Add New
                        </button>

                    </div>
                `;

                        wrapper.appendChild(div);

                        updateButtons(wrapper);
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | Remove
                    |--------------------------------------------------------------------------
                    */
                    if (e.target.classList.contains('remove-btn')) {

                        const rows = wrapper.querySelectorAll('.script-row');

                        if (rows.length <= 1) {
                            return;
                        }

                        e.target.closest('.script-row').remove();

                        updateButtons(wrapper);
                    }
                });
            }

            /*
            |--------------------------------------------------------------------------
            | Update Buttons
            |--------------------------------------------------------------------------
            */
            function updateButtons(wrapper) {
                const rows = wrapper.querySelectorAll('.script-row');

                rows.forEach((row, index) => {

                    const addBtn = row.querySelector('.add-btn');
                    const removeBtn = row.querySelector('.remove-btn');

                    // Only last row shows Add button
                    if (index === rows.length - 1) {
                        addBtn.classList.remove('hidden');
                    } else {
                        addBtn.classList.add('hidden');
                    }

                    // Hide remove if only one row
                    if (rows.length === 1) {
                        removeBtn.classList.add('hidden');
                    } else {
                        removeBtn.classList.remove('hidden');
                    }
                });
            }
        });
    </script>
@endpush
