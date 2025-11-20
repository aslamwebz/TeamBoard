<?php

namespace App\Livewire\Projects\Milestones;

use App\Models\Milestone;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('View Milestone')]
class Show extends Component
{
    public Milestone $milestone;

    public function mount(Milestone $milestone)
    {
        $this->milestone = $milestone;
    }

    public function render()
    {
        return view('livewire.projects.milestones.show');
    }
}