<?php

namespace App\Livewire\PurchaseOrders;

use App\Models\Project;
use App\Models\PurchaseOrder;
use App\Models\Task;
use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class PurchaseOrderEdit extends Component
{
    public PurchaseOrder $purchaseOrder;

    public $vendor_id;
    public string $po_number = '';
    public string $order_date = '';
    public string $required_date = '';
    public string $expected_delivery_date = '';
    public string $subtotal = '0.00';
    public string $tax_amount = '0.00';
    public string $total_amount = '0.00';
    public string $status = 'draft';
    public string $notes = '';
    public string $delivery_address = '';
    public string $shipping_method = '';
    public string $payment_terms = '';

    public function mount(PurchaseOrder $purchaseOrder) : void
    {
        $this->purchaseOrder = $purchaseOrder;
        $this->fill([
            'vendor_id' => $purchaseOrder->vendor_id,
            'po_number' => $purchaseOrder->po_number,
            'order_date' => $purchaseOrder->order_date->format('Y-m-d'),
            'required_date' => $purchaseOrder->required_date?->format('Y-m-d'),
            'expected_delivery_date' => $purchaseOrder->expected_delivery_date?->format('Y-m-d'),
            'subtotal' => $purchaseOrder->subtotal,
            'tax_amount' => $purchaseOrder->tax_amount,
            'total_amount' => $purchaseOrder->total_amount,
            'status' => $purchaseOrder->status,
            'notes' => $purchaseOrder->notes,
            'delivery_address' => $purchaseOrder->delivery_address,
            'shipping_method' => $purchaseOrder->shipping_method,
            'payment_terms' => $purchaseOrder->payment_terms,
        ]);
    }

    protected function rules() : array
    {
        return [
            'vendor_id' => 'required|exists:vendors,id',
            'po_number' => 'required|string|max:255|unique:purchase_orders,po_number,' . $this->purchaseOrder->id,
            'order_date' => 'required|date',
            'required_date' => 'nullable|date',
            'expected_delivery_date' => 'nullable|date',
            'subtotal' => 'required|numeric|min:0',
            'tax_amount' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:draft,pending,approved,sent,partially_received,received,closed,cancelled',
            'notes' => 'nullable|string',
            'delivery_address' => 'nullable|string',
            'shipping_method' => 'nullable|string|max:100',
            'payment_terms' => 'nullable|string|max:100',
        ];
    }

    public function update() : RedirectResponse
    {
        $this->validate();

        $this->purchaseOrder->update([
            'vendor_id' => $this->vendor_id,
            'po_number' => $this->po_number,
            'order_date' => $this->order_date,
            'required_date' => $this->required_date,
            'expected_delivery_date' => $this->expected_delivery_date,
            'subtotal' => $this->subtotal,
            'tax_amount' => $this->tax_amount,
            'total_amount' => $this->total_amount,
            'status' => $this->status,
            'notes' => $this->notes,
            'delivery_address' => $this->delivery_address,
            'shipping_method' => $this->shipping_method,
            'payment_terms' => $this->payment_terms,
        ]);

        return redirect()->route('purchase-orders.show', $this->purchaseOrder->id)->with('message', 'Purchase Order updated successfully.');
    }

    public function render() : View
    {
        $vendors = Vendor::orderBy('name')->get();
        $projects = Project::all();
        $tasks = Task::all();

        return view('livewire.purchase-orders.purchase-order-edit', [
            'vendors' => $vendors,
            'projects' => $projects,
            'tasks' => $tasks,
        ]);
    }
}