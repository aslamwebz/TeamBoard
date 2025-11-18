<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class TenantRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Role management
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',

            // Team management
            'view teams',
            'create teams',
            'edit teams',
            'delete teams',

            // Project management
            'view projects',
            'create projects',
            'edit projects',
            'delete projects',

            // Task management
            'view tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',

            // Client management
            'view clients',
            'create clients',
            'edit clients',
            'delete clients',

            // Invoice management
            'view invoices',
            'create invoices',
            'edit invoices',
            'delete invoices',

            // Report management
            'view reports',
            'create reports',
            'edit reports',
            'delete reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleManager = Role::firstOrCreate(['name' => 'manager']);
        $roleUser = Role::firstOrCreate(['name' => 'user']);

        // Admin role gets all permissions
        $roleAdmin->givePermissionTo(Permission::all());

        // Manager role gets most permissions except user deletion
        $roleManager->givePermissionTo([
            'view users',
            'create users',
            'edit users',
            'view roles',
            'view teams',
            'create teams',
            'edit teams',
            'view projects',
            'create projects',
            'edit projects',
            'view tasks',
            'create tasks',
            'edit tasks',
            'view clients',
            'create clients',
            'edit clients',
            'view invoices',
            'create invoices',
            'edit invoices',
            'view reports',
            'create reports',
            'edit reports',
            'delete reports',
        ]);

        // Standard user role gets basic permissions
        $roleUser->givePermissionTo([
            'view tasks',
            'create tasks',
            'edit tasks',
            'view projects',
            'view teams',
            'view reports',
        ]);

        // Create or update default users with roles
        $adminUser = User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin User',
            'password' => bcrypt('password'),
        ]);
        $adminUser->assignRole('admin');

        $managerUser = User::firstOrCreate([
            'email' => 'manager@example.com',
        ], [
            'name' => 'Manager User',
            'password' => bcrypt('password'),
        ]);
        $managerUser->assignRole('manager');

        $regularUser = User::firstOrCreate([
            'email' => 'user@example.com',
        ], [
            'name' => 'Regular User',
            'password' => bcrypt('password'),
        ]);
        $regularUser->assignRole('user');
    }
}