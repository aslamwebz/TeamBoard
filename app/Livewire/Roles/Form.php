<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Form extends Component
{
    public $role;
    public $name;
    public array $permissions = [];
    public $allPermissions;

    public function mount($role = null)
    {
        $this->allPermissions = Permission::all();

        if ($role) {
            // Check if $role is already a Role model instance or just an ID
            if (is_string($role) || is_numeric($role)) {
                $this->role = Role::findOrFail($role);
            } else {
                $this->role = $role;
            }

            $this->name = $this->role->name;

            // Get the current permissions for the role and ensure they're integers
            $permissionIds = $this->role->permissions->pluck('id')->map(function($id) {
                return (int)$id;
            })->toArray();
            $this->permissions = $permissionIds;
        } else {
            $this->permissions = [];
            $this->role = null;
        }

    }

    public function getGroupedPermissionsProperty()
    {
        $permissions = $this->allPermissions;

        $grouped = [];

        foreach ($permissions as $permission) {
            // Determine category based on the permission name
            if (str_starts_with($permission->name, 'view users') ||
                str_starts_with($permission->name, 'create users') ||
                str_starts_with($permission->name, 'edit users') ||
                str_starts_with($permission->name, 'delete users')) {
                $category = 'User Management';
            } elseif (str_starts_with($permission->name, 'view roles') ||
                      str_starts_with($permission->name, 'create roles') ||
                      str_starts_with($permission->name, 'edit roles') ||
                      str_starts_with($permission->name, 'delete roles')) {
                $category = 'Role Management';
            } elseif (str_starts_with($permission->name, 'view teams') ||
                      str_starts_with($permission->name, 'create teams') ||
                      str_starts_with($permission->name, 'edit teams') ||
                      str_starts_with($permission->name, 'delete teams')) {
                $category = 'Team Management';
            } elseif (str_starts_with($permission->name, 'view projects') ||
                      str_starts_with($permission->name, 'create projects') ||
                      str_starts_with($permission->name, 'edit projects') ||
                      str_starts_with($permission->name, 'delete projects')) {
                $category = 'Project Management';
            } elseif (str_starts_with($permission->name, 'view tasks') ||
                      str_starts_with($permission->name, 'create tasks') ||
                      str_starts_with($permission->name, 'edit tasks') ||
                      str_starts_with($permission->name, 'delete tasks')) {
                $category = 'Task Management';
            } elseif (str_starts_with($permission->name, 'view clients') ||
                      str_starts_with($permission->name, 'create clients') ||
                      str_starts_with($permission->name, 'edit clients') ||
                      str_starts_with($permission->name, 'delete clients')) {
                $category = 'Client Management';
            } elseif (str_starts_with($permission->name, 'view invoices') ||
                      str_starts_with($permission->name, 'create invoices') ||
                      str_starts_with($permission->name, 'edit invoices') ||
                      str_starts_with($permission->name, 'delete invoices')) {
                $category = 'Invoice Management';
            } else {
                $category = 'General';
            }

            if (!isset($grouped[$category])) {
                $grouped[$category] = [];
            }

            $grouped[$category][] = $permission;
        }

        return $grouped;
    }


    public function save()
    {
        $validated = $this->validate([
            'name' => $this->role ? 'required|string|max:255|unique:roles,name,' . $this->role->id : 'required|string|max:255|unique:roles,name',
            'permissions' => 'array',
        ]);

        if ($this->role) {
            $this->role->update(['name' => $this->name]);
            $this->role->syncPermissions($this->permissions);
            session()->flash('success', 'Role updated successfully.');
        } else {
            $newRole = Role::create(['name' => $this->name]);
            $newRole->syncPermissions($this->permissions);
            session()->flash('success', 'Role created successfully.');
        }

        return redirect()->route('roles.index');
    }

    public function render()
    {
        return view('livewire.roles.form');
    }
}
