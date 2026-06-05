@extends('backend.layouts.app')

@section('content')
    <div class="space-y-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">Create User</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Assign one primary role and any additional role containers.</p>
        </div>

        <form method="POST" action="{{ role_route('role.users.store') }}" class="space-y-6">
            @csrf
            @include('backend.pages.users.partials.form', ['user' => null])
        </form>
    </div>
@endsection
