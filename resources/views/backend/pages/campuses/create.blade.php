@extends('backend.layouts.app')

@section('content')
    <form action="{{ role_route('role.campuses.create') }}" method="POST" enctype="multipart/form-data">
        <form action="{{ role_route('role.campuses.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

                <div class="lg:col-span-8 space-y-6">

                    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">

                        <div class="border-b border-gray-100 p-5 dark:border-gray-800">
                            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                                Campus Information
                            </h2>
                        </div>

                        <div class="p-5 space-y-5">

                            {{-- University --}}
                            <div>
                                <label class="mb-2 block text-sm font-medium">
                                    University
                                </label>

                                <select name="university_id" class="w-full rounded-lg border border-gray-300 px-4 py-2">
                                    <option value="">
                                        Select University
                                    </option>

                                    @foreach ($universities as $university)
                                        <option value="{{ $university->id }}" @selected(old('university_id') == $university->id)>
                                            {{ $university->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('university_id')
                                    <p class="mt-1 text-sm text-red-500">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            {{-- Name --}}
                            <x-form.input-text name="name" label="Campus Name" value="{{ old('name') }}"
                                placeholder="Enter campus name..." />

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                <x-form.input-text name="email" label="Email" type="email"
                                    value="{{ old('email') }}" />

                                <x-form.input-text name="phone" label="Phone" value="{{ old('phone') }}" />

                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                                <x-form.input-text name="country" label="Country" value="{{ old('country') }}" />

                                <x-form.input-text name="state" label="State" value="{{ old('state') }}" />

                                <x-form.input-text name="city" label="City" value="{{ old('city') }}" />

                            </div>

                            <x-form.textarea-input name="address" label="Address" rows="3"
                                placeholder="Campus address..." />

                            <x-form.textarea-input name="description" label="Description" rows="5"
                                placeholder="Campus description..." />

                        </div>

                    </div>
                    <button type="submit"
                        class="w-full rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-700">
                        Create Campus
                    </button>

                </div>

            </div>

        </form>

    </form>
@endsection
