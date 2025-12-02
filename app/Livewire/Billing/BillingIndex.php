<?php

declare(strict_types=1);

namespace App\Livewire\Billing;

use Illuminate\Contracts\View\View;
use Livewire\Component;

final class BillingIndex extends Component
{
    public function render(): View
    {
        return view('livewire.billing.billing-index');
    }
}
