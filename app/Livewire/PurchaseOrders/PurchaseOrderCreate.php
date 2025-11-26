<?php

namespace App\Livewire\PurchaseOrders;

use App\Models\PurchaseOrder;
use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class PurchaseOrderCreate extends Component
{
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

    protected $rules = [
        'vendor_id' => 'required|exists:vendors,id',
        'po_number' => 'required|string|max:255|unique:purchase_orders,po_number',
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

    public function mount() : void
    {
        $this->order_date = now()->format('Y-m-d');
        $this->po_number = 'PO-' . now()->format('Ymd') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }

    public function save() : RedirectResponse
    {
        $this->validate();

        $purchaseOrder = PurchaseOrder::create([
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
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('purchase-orders.show', $purchaseOrder->id)->with('message', 'Purchase Order created successfully.');
    }

    public function render() : View
    {
        $vendors = Vendor::orderBy('name')->get();
        return view('livewire.purchase-orders.purchase-order-create', [
            'vendors' => $vendors,
        ]);
    }
}