<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

interface PermissionRepositoryInterface
{
    public function allGroupedByFeature(): Collection;

    public function findByNames(array $names): Collection;

    public function firstOrCreate(string $name, ?string $guardName = null): Permission;
}
