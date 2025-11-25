<?php

namespace App\Livewire\Vendors;

use App\Models\Vendor;
use Livewire\Component;

class VendorShow extends Component
{
    public Vendor $vendor;

    public function mount(Vendor $vendor)
    {
        $this->vendor = $vendor->load(['contacts', 'services', 'invoices']);
    }

    public function render()
    {
        return view('livewire.vendors.show');
    }

    public function getVendorStatusBadgeClass(string $status): string
    {
        return match($status) {
            'active' => 'bg-green-100 text-green-800',
            'inactive' => 'bg-red-100 text-red-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getInvoiceStatusBadgeClass(string $status): string
    {
        return match($status) {
            'paid' => 'bg-green-100 text-green-800',
            'overdue' => 'bg-red-100 text-red-800',
            'cancelled' => 'bg-gray-100 text-gray-800',
            'draft' => 'bg-blue-100 text-blue-800',
            'sent' => 'bg-purple-100 text-purple-800',
            default => 'bg-yellow-100 text-yellow-800',
        };
    }
}