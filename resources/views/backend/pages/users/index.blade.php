@extends('backend.layouts.app')

@section('content')
    <div class="space-y-6">
        @if (session('success'))
            <x-ui.alert variant="success" title="" message="{{ session('success') }}" />
        @endif

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Users</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage accounts, status, primary role, and assigned roles.</p>
            </div>

            @can('user.create')
                <a href="{{ role_route('role.users.create') }}"
                    class="inline-flex items-center rounded-lg bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-600">
                    Add User
                </a>
            @endcan
        </div>

        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase text-gray-500">Primary Role</th>
                        <th class="px-4 py-3 text-right text-xs font-medium uppercase text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($users as $user)
                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ ucfirst($user->status) }}</td>
                            <td class="px-4 py-3 text-sm text-gray-500">{{ $user->primaryRole?->name ?? $user->roles->first()?->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-right text-sm">
                                <div class="inline-flex items-center gap-3">
                                    @can('user.view')
                                        <a href="{{ role_route('role.users.show', ['user' => $user]) }}" class="text-gray-600 hover:text-gray-900">View</a>
                                    @endcan
                                    @can('user.edit')
                                        <a href="{{ role_route('role.users.edit', ['user' => $user]) }}" class="text-brand-600 hover:text-brand-700">Edit</a>
                                    @endcan
                                    @can('user.delete')
                                        @if (! auth()->user()->is($user))
                                            <form method="POST" action="{{ role_route('role.users.destroy', ['user' => $user]) }}" onsubmit="return confirm('Delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-700">Delete</button>
                                            </form>
                                        @endif
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $users->links() }}
    </div>
@endsection
