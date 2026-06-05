<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function __construct(
        private readonly RoleRepositoryInterface $roles,
        private readonly PermissionRepositoryInterface $permissions,
    ) {}

    public function index(Request $request): View
    {
        $request->user()->can('role.list') || abort(403);

        return view('backend.pages.roles-permissions.index', [
            'roles' => $this->roles->paginate(),
            'permissions' => $this->permissions->allGroupedByFeature(),
            'title' => 'Roles & Permissions',
        ]);
    }

    public function create(Request $request): View
    {
        $request->user()->can('role.create') || abort(403);

        return view('backend.pages.roles-permissions.create', [
            'permissions' => $this->permissions->allGroupedByFeature(),
            'title' => 'Create Role',
        ]);
    }

    public function store(RoleStoreRequest $request): RedirectResponse
    {
        $role = $this->roles->create($request->validated());
        $this->roles->syncPermissions($role, $request->input('permissions', []));

        return redirect()
            ->route('role.roles-permissions.index', ['role' => $request->route('role')])
            ->with('success', 'Role created successfully.');
    }

    public function show(Request $request, string $role, Role $roles_permission): View
    {
        $request->user()->can('role.view') || abort(403);

        return view('backend.pages.roles-permissions.show', [
            'role' => $roles_permission->load('permissions'),
            'title' => 'Role Details',
        ]);
    }

    public function edit(Request $request, string $role, Role $roles_permission): View
    {
        $request->user()->can('role.edit') || abort(403);

        return view('backend.pages.roles-permissions.edit', [
            'role' => $roles_permission->load('permissions'),
            'permissions' => $this->permissions->allGroupedByFeature(),
            'title' => 'Edit Role',
        ]);
    }

    public function update(RoleUpdateRequest $request, string $role, Role $roles_permission): RedirectResponse
    {
        $role_model = $this->roles->update($roles_permission, $request->validated());
        $this->roles->syncPermissions($role_model, $request->input('permissions', []));

        return redirect()
            ->route('role.roles-permissions.index', ['role' => $request->route('role')])
            ->with('success', 'Role updated successfully.');
    }

    public function destroy(Request $request, string $role, Role $roles_permission): RedirectResponse
    {
        $request->user()->can('role.delete') || abort(403);

        if ($roles_permission->name === config('rbac.super_admin_role')) {
            abort(403, 'The super admin role cannot be deleted.');
        }

        $this->roles->delete($roles_permission);

        return redirect()
            ->route('role.roles-permissions.index', ['role' => $request->route('role')])
            ->with('success', 'Role deleted successfully.');
    }
}
