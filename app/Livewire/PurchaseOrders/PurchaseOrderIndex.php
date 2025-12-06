<?php

declare(strict_types=1);

namespace App\Livewire\PurchaseOrders;

use App\Models\PurchaseOrder;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

final class PurchaseOrderIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public string $status = '';

    public int $perPage = 10;

    protected $queryString = ['search', 'status'];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $query = PurchaseOrder::with(['vendor', 'creator']);

        if ($this->search) {
            $query->where('po_number', 'like', '%'.$this->search.'%')
                ->orWhereHas('vendor', function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%');
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
        $poStatus = \App\Enums\PurchaseOrderStatus::tryFrom($status);
        if ($poStatus) {
            return $poStatus->getColorClass();
        }

        return 'bg-gray-100 text-gray-800';
    }
}
