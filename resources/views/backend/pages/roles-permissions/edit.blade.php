@extends('backend.layouts.app')

@section('content')
    <div class="space-y-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Edit Role</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Changing permissions updates access for every user with this role.</p>
        </div>

        <form method="POST" action="{{ role_route('role.roles-permissions.update', ['roles_permission' => $role]) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('backend.pages.roles-permissions.partials.form', ['role' => $role])
        </form>
    </div>
@endsection
