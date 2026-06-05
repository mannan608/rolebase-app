<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
    ) {}

    public function index(Request $request): View
    {
        $request->user()->can('user.list') || abort(403);

        return view('backend.pages.users.index', [
            'users' => $this->users->paginate(),
            'title' => 'Users',
        ]);
    }

    public function create(Request $request): View
    {
        $request->user()->can('user.create') || abort(403);

        return view('backend.pages.users.create', [
            'user' => null,
            'roles' => $this->roles(),
            'title' => 'Create User',
        ]);
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $this->users->create($request->validated());

        return redirect()
            ->route('role.users.index', ['role' => $request->route('role')])
            ->with('success', 'User created successfully.');
    }

    public function show(Request $request, string $role, User $user): View
    {
        $request->user()->can('user.view') || abort(403);

        return view('backend.pages.users.show', [
            'user' => $user->load('roles', 'primaryRole'),
            'title' => 'User Details',
        ]);
    }

    public function edit(Request $request, string $role, User $user): View
    {
        $request->user()->can('user.edit') || abort(403);

        return view('backend.pages.users.edit', [
            'user' => $user->load('roles', 'primaryRole'),
            'roles' => $this->roles(),
            'title' => 'Edit User',
        ]);
    }

    public function update(UserUpdateRequest $request, string $role, User $user): RedirectResponse
    {
        if ($request->user()->is($user) && $request->input('status') !== 'active') {
            abort(403, 'You cannot deactivate your own account.');
        }

        $this->users->update($user, $request->validated());

        return redirect()
            ->route('role.users.index', ['role' => $request->route('role')])
            ->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request, string $role, User $user): RedirectResponse
    {
        $request->user()->can('user.delete') || abort(403);

        if ($request->user()->is($user)) {
            abort(403, 'You cannot delete your own account.');
        }

        $this->users->delete($user);

        return redirect()
            ->route('role.users.index', ['role' => $request->route('role')])
            ->with('success', 'User deleted successfully.');
    }

    private function roles()
    {
        return Role::query()->orderBy('name')->get(['id', 'name']);
    }
}
