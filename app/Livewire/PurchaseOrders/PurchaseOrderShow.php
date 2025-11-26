<?php

namespace App\Livewire\PurchaseOrders;

use App\Models\PurchaseOrder;
use Livewire\Component;

class PurchaseOrderShow extends Component
{
    public PurchaseOrder $purchaseOrder;

    public function mount(PurchaseOrder $purchaseOrder)
    {
        $this->purchaseOrder = $purchaseOrder->load(['vendor', 'creator', 'approver', 'items']);
    }

    public function render()
    {
        return view('livewire.purchase-orders.purchase-order-show');
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