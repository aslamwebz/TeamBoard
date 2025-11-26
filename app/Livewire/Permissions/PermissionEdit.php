<?php

namespace App\Livewire\Permissions;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionEdit extends Component
{
    public $permission;
    public $name;
    public $guard_name;

    public function mount(Permission $permission) : void
    {
        $this->permission = $permission;
        $this->name = $permission->name;
        $this->guard_name = $permission->guard_name;
    }

    public function save() : RedirectResponse
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $this->permission->id,
            'guard_name' => 'required|string|max:255',
        ]);

        $this->permission->update($validated);

        session()->flash('success', 'Permission updated successfully.');
        return redirect()->route('roles.index');
    }

    public function render() : View
    {
        return view('livewire.permissions.permission-edit');
    }
}