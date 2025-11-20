<?php

namespace App\Livewire\Projects\Phases;

use App\Models\ProjectPhase;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('View Phase')]
class Show extends Component
{
    public ProjectPhase $phase;

    public function mount(ProjectPhase $phase)
    {
        $this->phase = $phase;
    }

    public function render()
    {
        return view('livewire.projects.phases.show');
    }
}