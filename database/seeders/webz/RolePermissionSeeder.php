<?php

namespace Database\Seeders\webz;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // User permissions
            'view users',
            'create users',
            'edit users',
            'delete users',
            
            // Role permissions
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            
            // Permission permissions
            'view permissions',
            'assign permissions',
            
            // Project permissions
            'view projects',
            'create projects',
            'edit projects',
            'delete projects',
            
            // Task permissions
            'view tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            
            // Client permissions
            'view clients',
            'create clients',
            'edit clients',
            'delete clients',
            
            // Invoice permissions
            'view invoices',
            'create invoices',
            'edit invoices',
            'delete invoices',
            
            // Report permissions
            'view reports',
            'create reports',
            'edit reports',
            'delete reports',
            
            // Team permissions
            'view teams',
            'create teams',
            'edit teams',
            'delete teams',
            
            // Vendor permissions
            'view vendors',
            'create vendors',
            'edit vendors',
            'delete vendors',
            
            // Purchase Order permissions
            'view purchase-orders',
            'create purchase-orders',
            'edit purchase-orders',
            'delete purchase-orders',
            
            // Worker permissions
            'view workers',
            'create workers',
            'edit workers',
            'delete workers',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $employeeRole = Role::firstOrCreate(['name' => 'employee']);
        $clientRole = Role::firstOrCreate(['name' => 'client']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all());
        $managerRole->givePermissionTo([
            'view users', 'create users', 'edit users',
            'view projects', 'create projects', 'edit projects',
            'view tasks', 'create tasks', 'edit tasks',
            'view clients', 'create clients', 'edit clients',
            'view invoices', 'create invoices', 'edit invoices',
            'view reports',
            'view teams', 'create teams', 'edit teams',
            'view vendors', 'view purchase-orders',
            'view workers',
        ]);
        $employeeRole->givePermissionTo([
            'view projects',
            'view tasks',
            'view clients',
            'view reports',
        ]);
    }
}