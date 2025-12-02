<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('View Invoice')]
final class InvoiceShow extends Component
{
    public Invoice $invoice;

    public function mount(Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.invoices.invoice-show');
    }
}
