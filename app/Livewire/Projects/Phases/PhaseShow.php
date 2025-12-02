<?php

declare(strict_types=1);

namespace App\Livewire\Projects\Phases;

use App\Models\ProjectPhase;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('View Phase')]
final class PhaseShow extends Component
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
