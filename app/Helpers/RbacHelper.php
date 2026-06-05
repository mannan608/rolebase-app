<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

if (! function_exists('user_primary_role')) {
    function user_primary_role(?User $user = null): ?string
    {
        $user ??= Auth::user();

        if (! $user instanceof User) {
            return null;
        }

        return $user->primaryRole?->name
            ?? $user->roles->first()?->name
            ?? $user->roles()->orderBy('name')->value('name');
    }
}

if (! function_exists('user_role_prefix')) {
    function user_role_prefix(?User $user = null): ?string
    {
        $role = user_primary_role($user);

        return $role ? Str::slug($role) : null;
    }
}

if (! function_exists('role_route')) {
    function role_route(string $name, array $parameters = [], bool $absolute = true): string
    {
        $parameters = ['role' => $parameters['role'] ?? user_role_prefix()] + $parameters;

        return route($name, $parameters, $absolute);
    }
}
