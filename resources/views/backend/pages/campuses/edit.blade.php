@extends('backend.layouts.app')

@section('content')
    <form action="{{ role_route('role.campuses.update', ['campus' => $campus->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">

            <div class="lg:col-span-8 space-y-6">

                <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">

                    <div class="border-b border-gray-100 p-5 dark:border-gray-800">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                            Edit Campus
                        </h2>
                    </div>

                    <div class="p-5 space-y-5">

                        {{-- University --}}
                        <div>
                            <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                University
                            </label>

                            <select name="university_id"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:border-brand-500 focus:outline-none">

                                <option value="">
                                    Select University
                                </option>

                                @foreach ($universities as $university)
                                    <option value="{{ $university->id }}" @selected(old('university_id', $campus->university_id) == $university->id)>
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
                        <x-form.input-text name="name" label="Campus Name" value="{{ old('name', $campus->name) }}"
                            placeholder="Enter campus name..." />

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            <x-form.input-text name="email" label="Email" type="email"
                                value="{{ old('email', $campus->email) }}" />

                            <x-form.input-text name="phone" label="Phone" value="{{ old('phone', $campus->phone) }}" />

                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                            <x-form.input-text name="country" label="Country"
                                value="{{ old('country', $campus->country) }}" />

                            <x-form.input-text name="state" label="State" value="{{ old('state', $campus->state) }}" />

                            <x-form.input-text name="city" label="City" value="{{ old('city', $campus->city) }}" />

                        </div>

                        <x-form.textarea-input name="address" label="Address" rows="3">
                            {{ old('address', $campus->address) }}
                        </x-form.textarea-input>

                        <x-form.textarea-input name="description" label="Description" rows="5">
                            {{ old('description', $campus->description) }}
                        </x-form.textarea-input>

                    </div>

                </div>
                <div class="mt-5">
                    <button type="submit"
                        class="w-full rounded-lg bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-700">
                        Update Campus
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
