<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            // Core
            'view_dashboard',

            // Courses
            'view_courses',
            'show_course',
            'create_course',
            'update_course',
            'delete_course',

            // Users
            'view_users',
            'show_user',
            'create_user',
            'update_user',
            'delete_user',

            // Roles
            'view_roles',
            'show_role',
            'create_role',
            'update_role',
            'delete_role',

            //Reports
            'view_user_reports',
            'view_course_reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Spatie Role for Admin
        // This is the role that the user with static role 'admin' will have
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo($permissions);

        // We don't need a role for Super Admin because they bypass checks.
        // We don't need a role for Employee because they have fixed access (or we could add one if we wanted granular employee perms later).
    }
}
