@php
    $selectedRoles = old('roles', $user?->roles->pluck('id')->map(fn ($id) => (string) $id)->all() ?? []);
    $selectedPrimaryRole = old('primary_role_id', $user?->primary_role_id);
@endphp

<div class="grid gap-5 rounded-lg border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900 md:grid-cols-2">
    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="name">Name</label>
        <input id="name" name="name" value="{{ old('name', $user?->name) }}" required
            class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm text-gray-800 focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white">
        @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email', $user?->email) }}" required
            class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm text-gray-800 focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white">
        @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="password">Password</label>
        <input id="password" type="password" name="password" @if (! $user) required @endif
            class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm text-gray-800 focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white">
        @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" @if (! $user) required @endif
            class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm text-gray-800 focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white">
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="status">Status</label>
        <select id="status" name="status" required
            class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm text-gray-800 focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white">
            @foreach (['active', 'inactive', 'suspended'] as $status)
                <option value="{{ $status }}" @selected(old('status', $user?->status ?? 'active') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>
        @error('status')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="primary_role_id">Primary Role</label>
        <select id="primary_role_id" name="primary_role_id" required
            class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm text-gray-800 focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white">
            <option value="">Select role</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" @selected((string) $selectedPrimaryRole === (string) $role->id)>{{ $role->name }}</option>
            @endforeach
        </select>
        @error('primary_role_id')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="rounded-lg border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
    <h4 class="mb-4 text-sm font-semibold uppercase text-gray-700 dark:text-gray-300">Assigned Roles</h4>
    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($roles as $role)
            <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                <input type="checkbox" name="roles[]" value="{{ $role->id }}" @checked(in_array((string) $role->id, array_map('strval', $selectedRoles), true))
                    class="rounded border-gray-300 text-brand-600 focus:ring-brand-500">
                <span>{{ $role->name }}</span>
            </label>
        @endforeach
    </div>
    @error('roles')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center gap-3">
    <button type="submit" class="rounded-lg bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">
        Save User
    </button>
    <a href="{{ role_route('role.users.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 dark:border-gray-700 dark:text-gray-300">
        Cancel
    </a>
</div>
