@extends('backend.layouts.app')

@section('content')
    <form action="{{ role_route('role.universities.update', ['university' => $university->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

            <div class="lg:col-span-8 space-y-6">

                {{-- University Information --}}
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">

                    <div class="border-b border-gray-100 p-5 dark:border-gray-800">

                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                            University Information
                        </h2>

                    </div>

                    <div class="p-5 space-y-5">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Name --}}
                            <x-form.input-text name="name" label="University Name"
                                value="{{ old('name', $university->name) }}" placeholder="Enter university name..." />

                            {{-- Short Name --}}
                            <x-form.input-text name="short_name" label="Short Name"
                                value="{{ old('short_name', $university->short_name) }}"
                                placeholder="e.g. MIT, Harvard..." />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            {{-- Email --}}
                            <x-form.input-text name="email" label="Email Address" type="email"
                                value="{{ old('email', $university->email) }}" placeholder="Enter contact email..." />

                            {{-- Phone --}}
                            <x-form.input-text name="phone" label="Phone Number"
                                value="{{ old('phone', $university->phone) }}" placeholder="Enter contact phone..." />
                        </div>

                        {{-- Website --}}
                        <x-form.input-text name="website" label="Website URL" type="url"
                            value="{{ old('website', $university->website) }}" placeholder="https://..." />

                        {{-- Description --}}
                        <x-form.textarea-input name="description" label="Description" rows="5"
                            placeholder="Enter university description..." :value="old('description', $university->description)" />

                    </div>

                </div>

                {{-- Location --}}
                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">

                    <div class="border-b border-gray-100 p-5 dark:border-gray-800">

                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                            Location
                        </h2>

                    </div>

                    <div class="p-5 space-y-5">

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            {{-- Country --}}
                            <x-form.input-text name="country" label="Country"
                                value="{{ old('country', $university->country) }}" placeholder="Enter country..." />

                            {{-- State --}}
                            <x-form.input-text name="state" label="State/Province"
                                value="{{ old('state', $university->state) }}" placeholder="Enter state..." />

                            {{-- City --}}
                            <x-form.input-text name="city" label="City" value="{{ old('city', $university->city) }}"
                                placeholder="Enter city..." />
                        </div>

                        {{-- Address --}}
                        <x-form.textarea-input name="address" label="Full Address" rows="2"
                            placeholder="Enter full address..." :value="old('address', $university->address)" />

                    </div>

                </div>

            </div>

            <div class="lg:col-span-4">

                <div class=" space-y-6">
                    {{-- Logo --}}
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">

                        <div class="border-b border-gray-100 p-5 dark:border-gray-800">

                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                                University Logo
                            </h2>

                        </div>

                        <div class="p-5">

                            @if ($university->logo)
                                <div class="mb-4">
                                    <img src="{{ asset($university->logo) }}"
                                        class="w-20 h-20 object-contain rounded border border-gray-200" alt="logo">
                                </div>
                            @endif

                            <x-form.dropzone name="logo" label="Upload New Logo" />

                        </div>

                    </div>

                    {{-- Banner --}}
                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">

                        <div class="border-b border-gray-100 p-5 dark:border-gray-800">

                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                                University Banner
                            </h2>

                        </div>

                        <div class="p-5">

                            @if ($university->banner)
                                <div class="mb-4">
                                    <img src="{{ asset($university->banner) }}"
                                        class="w-full h-32 object-cover rounded border border-gray-200" alt="banner">
                                </div>
                            @endif

                            <x-form.dropzone name="banner" label="Upload New Banner" />

                        </div>

                    </div>

                </div>

                <div class="mt-5">
                    <button type="submit"
                        class="w-full rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-700">
                        Update University
                    </button>
                </div>

            </div>

        </div>
    </form>
@endsection
