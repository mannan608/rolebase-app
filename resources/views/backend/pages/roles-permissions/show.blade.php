@extends('backend.layouts.app')

@section('content')
    <div class="space-y-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">{{ $role->name }}</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Assigned permissions: {{ $role->permissions->count() }}</p>
        </div>

        <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($role->permissions as $permission)
                <span class="rounded border border-gray-200 px-3 py-2 text-sm text-gray-700 dark:border-gray-800 dark:text-gray-300">
                    {{ $permission->name }}
                </span>
            @endforeach
        </div>
    </div>
@endsection
