@extends('backend.layouts.app')

@section('content')
    <form action="{{ role_route('role.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

            <div class="lg:col-span-8 space-y-6">
                <div class="rounded-xl border border-gray-200 dark:border-gray-800 p-5 bg-white dark:bg-gray-900">

                    <h3 class="text-lg font-semibold mb-5 dark:text-white">
                        Basic Information
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <x-form.input-text name="title" label="Event Title" placeholder="Enter event title" />
                        <x-form.input-text name="registration_link" label="Registration Link"
                            placeholder="https://hbdservices.com/event/" />
                    </div>

                    <div class="mt-5">
                        <x-form.textarea-input name="short_description" label="Short Description" rows="3"
                            placeholder="Enter short description" />
                    </div>

                    <div class="mt-5">
                        <x-form.textarea-input name="description" label="Description" rows="3"
                            placeholder="Enter full description" />
                    </div>

                    <div class="mt-5">
                        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Banner Image
                        </label>

                        <x-form.dropzone name="banner" label="Banner" />
                    </div>

                </div>
                <div class="rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">

                    <div class="border-b border-gray-200 dark:border-gray-800 px-5 py-4">
                        <h3 class="text-lg font-semibold dark:text-white">
                            Event Schedules
                        </h3>
                    </div>

                    <div class="p-5">

                        <div id="schedule-wrapper">

                            <div class="dynamic-item border border-gray-200 dark:border-gray-700 rounded-xl p-4 mb-4">

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                                    <x-form.input-text name="schedules[0][location]" label="Location" placeholder="Dhaka" />

                                    <x-form.input-text name="schedules[0][start_date]" label="Start Date"
                                        type="datetime-local" />

                                    <x-form.input-text name="schedules[0][end_date]" label="End Date"
                                        type="datetime-local" />

                                </div>

                                <div class="flex justify-end gap-3 mt-4">

                                    <button type="button"
                                        class="remove-item hidden px-4 py-2 rounded-lg bg-red-500 text-white text-sm">
                                        Remove
                                    </button>

                                    <button type="button"
                                        class="add-item px-4 py-2 rounded-lg bg-brand-600 text-white text-sm">
                                        Add More
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">

                    <div class="border-b border-gray-200 dark:border-gray-800 px-5 py-4">
                        <h3 class="text-lg font-semibold dark:text-white">
                            Providers / Sponsors
                        </h3>
                    </div>

                    <div class="p-5">

                        <div id="provider-wrapper">

                            <div class="dynamic-item border border-gray-200 dark:border-gray-700 rounded-xl p-4 mb-4">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <x-form.input-text name="providers[0][name]" label="Provider Name"
                                        placeholder="Provider Name" />

                                    <div>
                                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                            Prodider Logo
                                        </label>
                                        <input type="file" name="providers[0][logo]"
                                            class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400" />
                                    </div>

                                </div>

                                <div class="flex justify-end gap-3 mt-4">

                                    <button type="button"
                                        class="remove-item hidden px-4 py-2 rounded-lg bg-red-500 text-white text-sm">
                                        Remove
                                    </button>

                                    <button type="button"
                                        class="add-item px-4 py-2 rounded-lg bg-brand-600 text-white text-sm">
                                        Add More
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="rounded-xl border border-gray-200 dark:border-gray-800 p-5 bg-white dark:bg-gray-900">
                    <label for="gallery_images"
                        class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-400">Gallery
                        Images</label>

                    <x-form.dropzone name="gallery_images[]" multiple label="Gallery Images" value=""
                        placeholder="Upload Gallery images..." />

                </div>

                <div class="rounded-xl border border-gray-200 dark:border-gray-800 p-5 bg-white dark:bg-gray-900">

                    <h3 class="text-lg font-semibold mb-5 dark:text-white">
                        Event Extra Info
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <x-form.input-text name="organizer" label="Organizer" placeholder="Organizer name" />


                        <x-form.input-text name="contact_email" label="Contact Email" placeholder="Contact@gmail.com" />

                        <x-form.input-text name="contact_phone" label="Contact Phone" placeholder="Contact Num" />

                        <x-form.input-text name="google_map_link" label="Google Map Link" placeholder="Google map link" />

                    </div>

                    <div class="mt-5">
                        <x-form.input-text name="tags" label="Tags" placeholder="Laravel, AI, Event" />
                    </div>

                </div>

                <div class="rounded-xl border border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">

                    <div class="border-b border-gray-200 dark:border-gray-800 px-5 py-4">
                        <h3 class="text-lg font-semibold dark:text-white">
                            FAQs
                        </h3>
                    </div>

                    <div class="p-5">

                        <div id="faq-wrapper">

                            <div class="dynamic-item border border-gray-200 dark:border-gray-700 rounded-xl p-4 mb-4">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <x-form.input-text name="faqs[0][question]" label="Question"
                                        placeholder="Question" />

                                    <x-form.input-text name="faqs[0][answer]" label="Answer" placeholder="Answer" />

                                </div>

                                <div class="flex justify-end gap-3 mt-4">

                                    <button type="button"
                                        class="remove-item hidden px-4 py-2 rounded-lg bg-red-500 text-white text-sm">
                                        Remove
                                    </button>

                                    <button type="button"
                                        class="add-item px-4 py-2 rounded-lg bg-brand-600 text-white text-sm">
                                        Add More
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


            </div>
            <div class="lg:col-span-4">
                <div class="sticky top-6 space-y-6">
                    <div class="rounded-xl border border-gray-200 dark:border-gray-800 p-5 bg-white dark:bg-gray-900">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <x-form.select-input name="status" label="Status" value="" :options="[
                                    'upcoming' => 'Upcoming',
                                    'ongoing' => 'Ongoing',
                                    'completed' => 'Completed',
                                    'cancelled' => 'Cancelled',
                                ]" />
                            </div>
                            <div>
                                <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Featured Event
                                </label>

                                <label class="inline-flex items-center gap-3">
                                    <input type="checkbox" name="is_featured" value="1"
                                        class="h-5 w-5 rounded border-gray-300 text-brand-600 focus:ring-brand-500">

                                    <span class="text-sm text-gray-600 dark:text-gray-400">
                                        Mark as featured
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="">

                        @include('backend.pages.seo.seo-form')

                    </div>

                </div>
            </div>
        </div>

        <div class="bg-white py-4 w-full h-20 mt-10 relative flex justify-end px-4">
            <div class="">
                <button type="submit" class=" px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white rounded-lg">
                    Save Event
                </button>
            </div>
        </div>
        {{-- <div class="fixed bottom-0 left-0 right-0 bg-white border-t shadow-lg z-50 px-4 py-4">
            <div class="max-w-7xl mx-auto flex justify-end">
                <button type="submit" class="px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white rounded-lg">
                    Save Event
                </button>
            </div>
        </div> --}}
        {{-- <div class="fixed bottom-0 right-0 -translate-x-1/2 max-w-(--breakpoint-2xl) w-full px-4 md:px-6 z-50">

            <div class="bg-white border-t shadow-lg rounded-t-xl py-4 flex justify-end">
                <button type="submit" class="px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white rounded-lg">
                    Save Event
                </button>
            </div>

        </div> --}}

    </form>
@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            dynamicRepeater({
                wrapper: '#schedule-wrapper',
                type: 'schedule'
            });

            dynamicRepeater({
                wrapper: '#provider-wrapper',
                type: 'provider'
            });

            dynamicRepeater({
                wrapper: '#faq-wrapper',
                type: 'faq'
            });

        });


        function dynamicRepeater(config) {

            const wrapper = document.querySelector(config.wrapper);

            updateButtons(wrapper);

            wrapper.addEventListener('click', function(e) {


                if (e.target.classList.contains('add-item')) {

                    const items = wrapper.querySelectorAll('.dynamic-item');

                    const index = items.length;

                    let html = '';

                    /* Schedule */

                    if (config.type === 'schedule') {

                        html = `
                <div class="dynamic-item border border-gray-200 dark:border-gray-700 rounded-xl p-4 mb-4">

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <input type="text"
                            name="schedules[${index}][location]"
                            placeholder="Location"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 dark:bg-gray-900 dark:border-gray-700 dark:text-white">

                        <input type="datetime-local"
                            name="schedules[${index}][start_date]"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 dark:bg-gray-900 dark:border-gray-700 dark:text-white">

                        <input type="datetime-local"
                            name="schedules[${index}][end_date]"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 dark:bg-gray-900 dark:border-gray-700 dark:text-white">

                    </div>

                    <div class="flex justify-end gap-3 mt-4">

                        <button type="button"
                            class="remove-item px-4 py-2 rounded-lg bg-red-500 text-white text-sm">
                            Remove
                        </button>

                        <button type="button"
                            class="add-item px-4 py-2 rounded-lg bg-brand-600 text-white text-sm">
                            Add More
                        </button>

                    </div>

                </div>
                `;
                    }

                    /* Provider */

                    if (config.type === 'provider') {

                        html = `
                <div class="dynamic-item border border-gray-200 dark:border-gray-700 rounded-xl p-4 mb-4">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <input type="text"
                            name="providers[${index}][name]"
                            placeholder="Provider Name"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 dark:bg-gray-900 dark:border-gray-700 dark:text-white">

                        <input type="file"
                            name="providers[${index}][logo]"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 dark:bg-gray-900 dark:border-gray-700 dark:text-white">

                    </div>

                    <div class="flex justify-end gap-3 mt-4">

                        <button type="button"
                            class="remove-item px-4 py-2 rounded-lg bg-red-500 text-white text-sm">
                            Remove
                        </button>

                        <button type="button"
                            class="add-item px-4 py-2 rounded-lg bg-brand-600 text-white text-sm">
                            Add More
                        </button>

                    </div>

                </div>
                `;
                    }

                    /* FAQ */

                    if (config.type === 'faq') {

                        html = `
                <div class="dynamic-item border border-gray-200 dark:border-gray-700 rounded-xl p-4 mb-4">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <input type="text"
                            name="faqs[${index}][question]"
                            placeholder="Question"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 dark:bg-gray-900 dark:border-gray-700 dark:text-white">

                        <input type="text"
                            name="faqs[${index}][answer]"
                            placeholder="Answer"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2 dark:bg-gray-900 dark:border-gray-700 dark:text-white">

                    </div>

                    <div class="flex justify-end gap-3 mt-4">

                        <button type="button"
                            class="remove-item px-4 py-2 rounded-lg bg-red-500 text-white text-sm">
                            Remove
                        </button>

                        <button type="button"
                            class="add-item px-4 py-2 rounded-lg bg-brand-600 text-white text-sm">
                            Add More
                        </button>

                    </div>

                </div>
                `;
                    }

                    wrapper.insertAdjacentHTML('beforeend', html);

                    updateButtons(wrapper);
                }

                /*REMOVE ITEM */

                if (e.target.classList.contains('remove-item')) {

                    const items = wrapper.querySelectorAll('.dynamic-item');

                    if (items.length <= 1) {
                        return;
                    }

                    e.target.closest('.dynamic-item').remove();

                    updateButtons(wrapper);
                }

            });

        }


        /*UPDATE BUTTONS*/

        function updateButtons(wrapper) {

            const items = wrapper.querySelectorAll('.dynamic-item');

            items.forEach((item, index) => {

                const addBtn = item.querySelector('.add-item');

                const removeBtn = item.querySelector('.remove-item');

                if (index === items.length - 1) {
                    addBtn.classList.remove('hidden');
                } else {
                    addBtn.classList.add('hidden');
                }

                if (items.length === 1) {
                    removeBtn.classList.add('hidden');
                } else {
                    removeBtn.classList.remove('hidden');
                }

            });

        }
    </script>
@endpush
