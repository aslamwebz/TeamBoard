<?php declare(strict_types=1);

namespace App\Livewire\Billing;

use Livewire\Component;
use Illuminate\Contracts\View\View;

class BillingIndex extends Component
{
    public function render() : View
    {
        return view('livewire.billing.billing-index');
    }
}
