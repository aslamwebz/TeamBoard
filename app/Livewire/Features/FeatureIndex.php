<?php

declare(strict_types=1);

namespace App\Livewire\Features;

use Livewire\Component;

final class FeatureIndex extends Component
{
    public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('livewire.features.feature-index');
    }
}
