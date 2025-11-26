<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Edit Team')]
class TeamEdit extends Component
{
    public Team $team;
    public $teamId;
    public $name = '';
    public $description = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
    ];

    public function mount(Team $team) : void
    {
        $this->team = $team;
        $this->teamId = $team->id;
        $this->name = $team->name;
        $this->description = $team->description;
    }

    public function updateTeam() : RedirectResponse
    {
        $validated = $this->validate();

        $this->team->update($validated);

        session()->flash('message', 'Team updated successfully.');

        return redirect()->route('teams.index');
    }

    public function render() : View
    {
        return view('livewire.teams.team-edit');
    }
}
