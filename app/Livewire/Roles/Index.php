<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;
    public $activeTab = 'roles'; // roles or permissions

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteRole($roleId)
    {
        $role = Role::findOrFail($roleId);

        // Only allow deleting roles that are not assigned to users
        if ($role->users()->count() > 0) {
            $this->dispatch('error', 'Cannot delete role that is assigned to users.');
            return;
        }

        $role->delete();
        $this->dispatch('success', 'Role deleted successfully.');
    }

    public function deletePermission($permissionId)
    {
        $permission = Permission::findOrFail($permissionId);

        // Only allow deleting permissions that are not assigned to roles
        if ($permission->roles()->count() > 0) {
            $this->dispatch('error', 'Cannot delete permission that is assigned to roles.');
            return;
        }

        $permission->delete();
        $this->dispatch('success', 'Permission deleted successfully.');
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        if ($this->activeTab === 'roles') {
            $roles = Role::where('name', 'like', '%' . $this->search . '%')
                ->with('permissions')
                ->paginate($this->perPage);

            return view('livewire.roles.index', [
                'roles' => $roles
            ]);
        } else {
            // For permissions tab
            $permissions = Permission::where('name', 'like', '%' . $this->search . '%')
                ->orderBy('name')
                ->paginate($this->perPage);

            return view('livewire.roles.index', [
                'permissions' => $permissions
            ]);
        }
    }
}
