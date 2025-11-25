<?php

namespace App\Livewire\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Edit extends Component
{
    public $permission;
    public $name;
    public $guard_name;

    public function mount(Permission $permission)
    {
        $this->permission = $permission;
        $this->name = $permission->name;
        $this->guard_name = $permission->guard_name;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $this->permission->id,
            'guard_name' => 'required|string|max:255',
        ]);

        $this->permission->update($validated);

        session()->flash('success', 'Permission updated successfully.');
        return redirect()->route('roles.index');
    }

    public function render()
    {
        return view('livewire.permissions.edit');
    }
}