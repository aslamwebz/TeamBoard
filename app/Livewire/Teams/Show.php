<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Team Details')]
class Show extends Component
{
    public Team $team;

    public function mount(Team $team)
    {
        $this->team = $team->load(['users', 'projects', 'clients']);
    }

    public function render()
    {
        return view('livewire.teams.show', [
            'team' => $this->team,
        ]);
    }
}
