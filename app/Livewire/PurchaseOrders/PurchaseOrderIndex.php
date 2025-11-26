<?php

namespace App\Livewire\PurchaseOrders;

use App\Models\PurchaseOrder;
use Livewire\Component;
use Livewire\WithPagination;

class PurchaseOrderIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';
    public int $perPage = 10;

    protected $queryString = ['search', 'status'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = PurchaseOrder::with(['vendor', 'creator']);

        if ($this->search) {
            $query->where('po_number', 'like', '%' . $this->search . '%')
                  ->orWhereHas('vendor', function ($q) {
                      $q->where('name', 'like', '%' . $this->search . '%');
                  });
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $purchaseOrders = $query->orderBy('order_date', 'desc')->paginate($this->perPage);

        return view('livewire.purchase-orders.purchase-order-index', [
            'purchaseOrders' => $purchaseOrders,
        ]);
    }

    public function getStatusBadgeClass(string $status): string
    {
        return match($status) {
            'draft' => 'bg-blue-100 text-blue-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            'sent' => 'bg-purple-100 text-purple-800',
            'partially_received' => 'bg-indigo-100 text-indigo-800',
            'received' => 'bg-green-100 text-green-800',
            'closed' => 'bg-gray-100 text-gray-800',
            'cancelled' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}