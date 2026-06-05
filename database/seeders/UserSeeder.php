<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::where('name', config('rbac.super_admin_role'))->firstOrFail();
        $adminRole = Role::where('name', 'admin')->firstOrFail();

        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'status' => 'active',
                'primary_role_id' => $superAdminRole->id,
            ]
        );

        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
                'status' => 'active',
                'primary_role_id' => $adminRole->id,
            ]
        );

        $superAdmin->syncRoles([$superAdminRole]);
        $admin->syncRoles([$adminRole]);
    }
}
