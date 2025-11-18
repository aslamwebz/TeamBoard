<?php

namespace App\Livewire\Permissions;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
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

    public function render()
    {
        $permissions = Permission::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.permissions.index', [
            'permissions' => $permissions
        ]);
    }
}