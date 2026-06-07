@extends('backend.layouts.app')

@section('title', $title)

@section('content')

<div class="max-w-7xl mx-auto">
<div class="bg-white dark:bg-gray-800 rounded-lg shadow">

    <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Create University
        </h2>
    </div>

    <form action="{{ route('role.universities.store', ['role' => request()->route('role')]) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf

        <div class="p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- University Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        University Name <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none @error('name') border-red-500 @enderror">

                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Short Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Short Name
                    </label>

                    <input
                        type="text"
                        name="short_name"
                        value="{{ old('short_name') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <!-- Website -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Website
                    </label>

                    <input
                        type="url"
                        name="website"
                        value="{{ old('website') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>

                    </select>
                </div>

                <!-- Country -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Country
                    </label>

                    <input
                        type="text"
                        name="country"
                        value="{{ old('country') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2">
                </div>

                <!-- State -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        State
                    </label>

                    <input
                        type="text"
                        name="state"
                        value="{{ old('state') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2">
                </div>

                <!-- City -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        City
                    </label>

                    <input
                        type="text"
                        name="city"
                        value="{{ old('city') }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2">
                </div>

                <!-- Sort Order -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Sort Order
                    </label>

                    <input
                        type="number"
                        name="sort_order"
                        value="{{ old('sort_order', 0) }}"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2">
                </div>

                <!-- Logo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Logo
                    </label>

                    <input
                        type="file"
                        name="logo"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2">
                </div>

                <!-- Banner -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Banner
                    </label>

                    <input
                        type="file"
                        name="banner"
                        class="w-full rounded-lg border border-gray-300 px-4 py-2">
                </div>

            </div>

            <!-- Address -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Address
                </label>

                <textarea
                    name="address"
                    rows="3"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2">{{ old('address') }}</textarea>
            </div>

            <!-- Description -->
            <div class="mt-6">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="w-full rounded-lg border border-gray-300 px-4 py-2">{{ old('description') }}</textarea>
            </div>

        </div>

        <div class="border-t border-gray-200 dark:border-gray-700 px-6 py-4 flex justify-end gap-3">

            <a href="{{ route('role.universities.index', ['role' => request()->route('role')]) }}"
               class="px-5 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg text-gray-700">
                Cancel
            </a>

            <button
                type="submit"
                class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                Save University
            </button>

        </div>

    </form>

</div>

</div>
@endsection
