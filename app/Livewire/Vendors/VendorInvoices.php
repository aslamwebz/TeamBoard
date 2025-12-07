<?php

declare(strict_types=1);

namespace App\Livewire\Vendors;

use App\Models\Vendor;
use App\Models\VendorInvoice;
use Livewire\Component;
use Livewire\WithPagination;

final class VendorInvoices extends Component
{
    use WithPagination;

    public $vendorId;

    public string $search = '';

    public string $status = '';

    public int $perPage = 10;

    protected $queryString = ['search', 'status'];

    public function mount($vendor): void
    {
        $this->vendorId = $vendor;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $vendor = Vendor::findOrFail($this->vendorId);

        $query = VendorInvoice::where('vendor_id', $this->vendorId);

        if ($this->search) {
            $query->where('invoice_number', 'like', '%'.$this->search.'%');
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $invoices = $query->orderBy('invoice_date', 'desc')->paginate($this->perPage);

        return view('livewire.vendors.vendor-invoices', [
            'vendor' => $vendor,
            'invoices' => $invoices,
        ]);
    }

    public function getStatusBadgeClass(string $status): string
    {
        $invoiceStatus = \App\Enums\InvoiceStatus::tryFrom($status);
        if ($invoiceStatus) {
            return $invoiceStatus->getColorClass();
        }

        return 'bg-yellow-100 text-yellow-800';
    }
}
