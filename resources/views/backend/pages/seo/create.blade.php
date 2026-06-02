@extends('backend.layouts.app')

@section('content')
    <div class="">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">SEO Management</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage Meta tags, Open Graph, and Schema for all routes.
                </p>
            </div>
        </div>

        <div class="mb-4">
            <form action="{{ route('admin.seo.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="space-y-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form.select-input name="type" label="Page Name" value="" :options="$routes" />
                        <x-form.input-text name="meta_title" label="Meta Title" value=""
                            placeholder="Enter meta title..." />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form.textarea-input name="meta_description" label="Meta Description"
                            placeholder="Enter a description..." rows="2" />

                        <x-form.textarea-input name="meta_keywords" label="Meta Keywords"
                            placeholder="Enter keywords separated by commas..." rows="2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form.input-text name="robots" label="Robots" value=""
                            placeholder="Enter robots directive..." />

                        <x-form.input-text name="canonical_url" label="Canonical URL" value=""
                            placeholder="Enter canonical URL..." />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="og-section space-y-3">
                            <x-form.input-text name="og_title" label="Open Graph Title" value=""
                                placeholder="Enter Open Graph title..." />

                            <x-form.input-text name="og_description" label="Open Graph Description" value=""
                                placeholder="Enter Open Graph description..." />

                            <div class="">
                                <label for="og_image"
                                    class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">Open Graph
                                    Image</label>
                                <x-form.dropzone name="og_image" label="Open Graph Image" value=""
                                    placeholder="Upload Open Graph image..." />
                            </div>
                        </div>
                        <div class="twitter-section space-y-3">
                            <x-form.input-text name="twitter_title" label="Twitter Title" value=""
                                placeholder="Enter Twitter title..." />

                            <x-form.input-text name="twitter_description" label="Twitter Description" value=""
                                placeholder="Enter Twitter description..." />
                            <div class="">
                                <label for="twitter_image"
                                    class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">Twitter
                                    Image</label>
                                <x-form.dropzone name="twitter_image" label="Twitter Image" value=""
                                    placeholder="Upload Twitter image..." />
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Header Scripts --}}
                        <div>
                            <div id="header-scripts-wrapper">
                                <label for=""
                                    class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">Header
                                    Scripts</label>
                                <div class="script-row space-y-3 mb-4">

                                    <x-form.textarea-input name="header_scripts[]" label=""
                                        placeholder="Enter header scripts..." rows="4" />

                                    <div class="flex justify-end gap-3">

                                        <button type="button"
                                            class="remove-btn hidden text-sm bg-red-500 py-1.5 px-4 rounded text-white">
                                            Remove
                                        </button>

                                        <button type="button"
                                            class="add-btn text-sm bg-brand-600 py-1.5 px-4 rounded text-white">
                                            Add New
                                        </button>

                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- Footer Scripts --}}
                        <div>
                            <div id="footer-scripts-wrapper">
                                <label for=""
                                    class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">Footer
                                    Scripts</label>

                                <div class="script-row space-y-3 mb-4">

                                    <x-form.textarea-input name="footer_scripts[]" label=""
                                        placeholder="Enter footer scripts..." rows="4" />

                                    <div class="flex justify-end gap-3">

                                        <button type="button"
                                            class="remove-btn hidden text-sm bg-red-500 py-1.5 px-4 rounded text-white">
                                            Remove
                                        </button>

                                        <button type="button"
                                            class="add-btn text-sm bg-brand-600 py-1.5 px-4 rounded text-white">
                                            Add New
                                        </button>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <x-form.textarea-input name="schema_markup" label="Schema Markup" placeholder="Enter schema markup..."
                        rows="4" />


                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="mt-6 inline-flex items-center justify-center rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                        Save SEO Meta
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {

        initializeDynamicFields('header-scripts-wrapper', 'header_scripts[]', 'Header Scripts');
        initializeDynamicFields('footer-scripts-wrapper', 'footer_scripts[]', 'Footer Scripts');

        function initializeDynamicFields(wrapperId, inputName, labelText) {
            const wrapper = document.getElementById(wrapperId);

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
