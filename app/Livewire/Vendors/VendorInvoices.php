<?php

namespace App\Livewire\Vendors;

use App\Models\VendorInvoice;
use Livewire\Component;
use Livewire\WithPagination;

class VendorInvoices extends Component
{
    use WithPagination;

    public $vendorId;
    public string $search = '';
    public string $status = '';
    public int $perPage = 10;

    protected $queryString = ['search', 'status'];

    public function mount($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = VendorInvoice::where('vendor_id', $this->vendorId);

        if ($this->search) {
            $query->where('invoice_number', 'like', '%' . $this->search . '%');
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $invoices = $query->orderBy('invoice_date', 'desc')->paginate($this->perPage);

        return view('livewire.vendors.vendor-invoices', [
            'invoices' => $invoices,
        ]);
    }

    public function getStatusBadgeClass(string $status): string
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