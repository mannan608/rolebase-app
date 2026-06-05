@extends('backend.layouts.app')

@section('content')
    <div class="space-y-6">
        @if (session('success'))
            <x-ui.alert variant="success" title="" message="{{ session('success') }}" />
        @endif

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Roles & Permissions</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Create database roles and attach permission containers.</p>
            </div>

            @can('role.create')
                <a href="{{ role_route('role.roles-permissions.create') }}"
                    class="inline-flex items-center rounded-lg bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-700">
                    Add Role
                </a>
            @endcan
        </div>

        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Role</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Permissions</th>
                        <th class="px-4 py-3 text-right text-xs font-medium uppercase text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($roles as $role)
                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900 dark:text-white">{{ $role->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $role->permissions_count }}</td>
                            <td class="px-4 py-3 text-right text-sm">
                                @can('role.edit')
                                    <a href="{{ role_route('role.roles-permissions.edit', ['roles_permission' => $role]) }}"
                                        class="text-brand-600 hover:text-brand-700">Edit</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $roles->links() }}
    </div>
@endsection
