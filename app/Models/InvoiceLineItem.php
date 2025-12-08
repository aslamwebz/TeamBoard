<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $invoice_id
 * @property string $description
 * @property string|null $detail
 * @property int $quantity
 * @property float $unit_price
 * @property float $total
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class InvoiceLineItem extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'invoice_id',
        'description',
        'detail',
        'quantity',
        'unit_price',
        'total',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'unit_price' => 'decimal:2',
        'total' => 'decimal:2',
        'quantity' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the invoice this line item belongs to.
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}
