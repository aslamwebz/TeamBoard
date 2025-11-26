<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Create Team')]
class TeamCreate extends Component
{
    public $name = '';
    public $description = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
    ];

    public function createTeam()
    {
        $validated = $this->validate();

        Team::create($validated);

        session()->flash('message', 'Team created successfully.');

        return redirect()->route('teams.index');
    }

    public function render()
    {
        return view('livewire.teams.team-create');
    }
}
