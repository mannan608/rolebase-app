@extends('backend.layouts.app')

@section('content')
    <div class="space-y-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Edit User</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Leave password blank to keep the current password.</p>
        </div>

        <form method="POST" action="{{ role_route('role.users.update', ['user' => $user]) }}" class="space-y-6">
            @csrf
            @method('PUT')
            @include('backend.pages.users.partials.form', ['user' => $user])
        </form>
    </div>
@endsection
