<?php

namespace App\Models;

use App\Models\PurchaseOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'name',
        'description',
        'unit_price',
        'quantity',
        'total_price',
        'unit_of_measure',
        'received_quantity',
        'service_code',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'quantity' => 'integer',
        'received_quantity' => 'integer',
    ];

    /**
     * Get the purchase order that this item belongs to.
     */
    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class, 'purchase_order_id');
    }

    /**
     * Check if this item is fully received.
     */
    public function isFullyReceived(): bool
    {
        return $this->received_quantity >= $this->quantity;
    }

    /**
     * Check if this item is partially received.
     */
    public function isPartiallyReceived(): bool
    {
        return $this->received_quantity > 0 && $this->received_quantity < $this->quantity;
    }

    /**
     * Check if this item hasn't been received yet.
     */
    public function isNotReceived(): bool
    {
        return $this->received_quantity === 0;
    }

    /**
     * Calculate the remaining quantity to be received.
     */
    public function remainingQuantity(): int
    {
        return max(0, $this->quantity - $this->received_quantity);
    }
}