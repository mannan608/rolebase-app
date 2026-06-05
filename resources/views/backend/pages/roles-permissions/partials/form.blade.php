<div class="rounded-lg border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
    <label class="mb-2 block text-sm font-medium text-gray-700 dark:text-gray-300" for="name">Role name</label>
    <input id="name" name="name" value="{{ old('name', $role?->name) }}" required
        class="h-11 w-full rounded-lg border border-gray-300 px-4 text-sm text-gray-800 focus:border-brand-500 focus:outline-none dark:border-gray-700 dark:bg-gray-900 dark:text-white">
    @error('name')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="space-y-4">
    @foreach ($permissions as $feature => $featurePermissions)
        <div class="rounded-lg border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-gray-900">
            <h4 class="mb-4 text-sm font-semibold uppercase text-gray-700 dark:text-gray-300">{{ $feature }}</h4>
            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($featurePermissions as $permission)
                    <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                            @checked(in_array($permission->name, old('permissions', $role?->permissions->pluck('name')->all() ?? []), true))
                            class="rounded border-gray-300 text-brand-600 focus:ring-brand-500">
                        <span>{{ $permission->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

<div class="flex items-center gap-3">
    <button type="submit" class="rounded-lg bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-700">
        Save Role
    </button>
    <a href="{{ role_route('role.roles-permissions.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm text-gray-700 dark:border-gray-700 dark:text-gray-300">
        Cancel
    </a>
</div>
