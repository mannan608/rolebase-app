<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class EnsureRolePrefixMatchesUser
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $requestedPrefix = (string) $request->route('role');

        if (! $user || $requestedPrefix === '') {
            abort(403);
        }

        $allowedPrefixes = $user->roles()
            ->pluck('name')
            ->map(fn (string $role): string => Str::slug($role));

        if (! $allowedPrefixes->contains($requestedPrefix)) {
            abort(403, 'The selected role workspace is not available for this user.');
        }

        return $next($request);
    }
}
