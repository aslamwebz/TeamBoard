<?php

namespace App\Livewire\Permissions;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Create extends Component
{
    public $name;
    public $guard_name = 'web';

    public function save()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'guard_name' => 'required|string|max:255',
        ]);

        Permission::create($validated);

        session()->flash('success', 'Permission created successfully.');
        return redirect()->route('roles.index');
    }

    public function render()
    {
        return view('livewire.permissions.create');
    }
}