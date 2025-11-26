<?php

namespace App\Livewire\Roles;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch() : void
    {
        $this->resetPage();
    }

    public function deleteRole($roleId) : void
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

    public function render() : View
    {
        $roles = Role::where('name', 'like', '%' . $this->search . '%')
            ->with('permissions')
            ->paginate($this->perPage);

        return view('livewire.roles.role-index', [
            'roles' => $roles
        ]);
    }
}
