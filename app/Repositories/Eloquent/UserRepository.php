<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    public function paginate(int $perPage = 25): LengthAwarePaginator
    {
        return User::query()
            ->with('roles:id,name', 'primaryRole:id,name')
            ->latest()
            ->paginate($perPage);
    }

    public function create(array $data): User
    {
        $roleIds = $data['roles'] ?? [];
        unset($data['roles']);

        if (! empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user = User::create($data);

        // Convert IDs to integer to ensure Spatie resolves by ID
        $user->syncRoles(array_map('intval', $roleIds));

        return $user->load('roles', 'primaryRole');
    }

    public function update(User $user, array $data): User
    {
        $roleIds = $data['roles'] ?? [];
        unset($data['roles']);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        // Convert IDs to integer to ensure Spatie resolves by ID
        $user->syncRoles(array_map('intval', $roleIds));

        return $user->load('roles', 'primaryRole');
    }

    public function delete(User $user): bool
    {
        return (bool) $user->delete();
    }
}
