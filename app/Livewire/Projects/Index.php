<?php

declare(strict_types=1);

namespace App\Livewire\Projects;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Projects')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.projects.index');
    }
}