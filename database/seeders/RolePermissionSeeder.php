<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'dashboard.view',

            'user.list',
            'user.view',
            'user.create',
            'user.edit',
            'user.delete',
            'user.impersonate',
            'user.status.change',

            'role.list',
            'role.view',
            'role.create',
            'role.edit',
            'role.delete',
            'role.manage',
            // 'permission.list',
            // 'permission.sync',

            'blog.list',
            'blog.view',
            'blog.create',
            'blog.edit',
            'blog.delete',
            'blog.publish',
            'blog.manage',

            'event.list',
            'event.view',
            'event.create',
            'event.edit',
            'event.delete',
            'event.manage',

            'seo.list',
            'seo.view',
            'seo.create',
            'seo.edit',
            'seo.delete',
            'seo.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => config('rbac.default_guard', 'web'),
            ]);
        }

        $superAdmin = Role::firstOrCreate([
            'name' => config('rbac.super_admin_role'),
            'guard_name' => config('rbac.default_guard', 'web'),
        ]);

        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => config('rbac.default_guard', 'web'),
        ]);

        $adminRole->syncPermissions($permissions);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
