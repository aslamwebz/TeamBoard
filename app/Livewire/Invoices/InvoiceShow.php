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

    public string $clientAddressString = '';

    public function mount(Invoice $invoice): void
    {
        $this->invoice = $invoice;
        $this->updateClientAddressString();
    }

    protected function updateClientAddressString(): void
    {
        $address = $this->invoice->client->address;
        $city = $this->invoice->client->city;
        $state = $this->invoice->client->state;
        $zipCode = $this->invoice->client->zip_code;
        $country = $this->invoice->client->country;

        $addressParts = array_filter([$address, $city, $state, $zipCode, $country]);
        $this->clientAddressString = implode(', ', $addressParts);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.invoices.invoice-show');
    }

    public function getInvoiceStatusBadgeClass(string $status): string
    {
        $invoiceStatus = \App\Enums\InvoiceStatus::tryFrom($status);
        if ($invoiceStatus) {
            return $invoiceStatus->getColorClass();
        }

        return 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
    }
}
