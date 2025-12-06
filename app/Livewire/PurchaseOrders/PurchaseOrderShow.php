<?php

declare(strict_types=1);

namespace App\Livewire\PurchaseOrders;

use App\Models\PurchaseOrder;
use Livewire\Component;

final class PurchaseOrderShow extends Component
{
    public PurchaseOrder $purchaseOrder;

    public function mount(PurchaseOrder $purchaseOrder): void
    {
        $this->purchaseOrder = $purchaseOrder->load(['vendor', 'creator', 'approver', 'items']);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.purchase-orders.purchase-order-show');
    }

    public function getStatusBadgeClass(string $status): string
    {
        $poStatus = \App\Enums\PurchaseOrderStatus::tryFrom($status);
        if ($poStatus) {
            return $poStatus->getColorClass();
        }

        return 'bg-gray-100 text-gray-800';
    }
}
