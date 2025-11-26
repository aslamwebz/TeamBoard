<?php

declare(strict_types=1);

namespace App\Livewire\Pricing;

use Livewire\Component;

class PricingIndex extends Component
{
    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.pricing.pricing-index');
    }
}