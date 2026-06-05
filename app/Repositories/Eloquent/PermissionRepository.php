<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\PermissionRepositoryInterface;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function allGroupedByFeature(): Collection
    {
        return Permission::query()
            ->orderBy('name')
            ->get()
            ->groupBy(fn (Permission $permission): string => str($permission->name)->before('.')->toString());
    }

    public function findByNames(array $names): Collection
    {
        return Permission::query()
            ->whereIn('name', $names)
            ->pluck('name');
    }

    public function firstOrCreate(string $name, ?string $guardName = null): Permission
    {
        return Permission::firstOrCreate([
            'name' => $name,
            'guard_name' => $guardName ?? config('rbac.default_guard', 'web'),
        ]);
    }
}
