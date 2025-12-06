<?php declare(strict_types=1);

namespace App\Livewire\Vendors;

use App\Models\Vendor;
use Livewire\Component;

final class VendorShow extends Component
{
    public Vendor $vendor;

    public string $activeTab = 'contacts';

    public function mount(Vendor $vendor): void
    {
        $this->vendor = $vendor->load([
            'contacts',
            'services',
            'invoices',
            'projects',
            'tasks'
        ]);
    }

    public function setActiveTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.vendors.vendor-show');
    }

    public function getVendorStatusBadgeClass(string $status): string
    {
        $vendorStatus = \App\Enums\VendorStatus::tryFrom($status);
        if ($vendorStatus) {
            return $vendorStatus->getColorClass();
        }

        return 'bg-gray-100 text-gray-800';
    }

    public function getInvoiceStatusBadgeClass(string $status): string
    {
        $invoiceStatus = \App\Enums\InvoiceStatus::tryFrom($status);
        if ($invoiceStatus) {
            return $invoiceStatus->getColorClass();
        }

        return 'bg-yellow-100 text-yellow-800';
    }
}
