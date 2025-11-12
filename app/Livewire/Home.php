<?php

declare(strict_types=1);

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.guest')]
class Home extends Component
{
    public function render()
    {
        return view('livewire.home');
    }
}