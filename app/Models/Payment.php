<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentStatus;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $invoice_id
 * @property int|null $expense_id
 * @property int|null $user_id
 * @property float $amount
 * @property string $payment_method
 * @property string|null $transaction_reference
 * @property CarbonInterface|null $payment_date
 * @property string|null $notes
 * @property string $status
 * @property string $currency
 * @property array|null $custom_fields
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class Payment extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'invoice_id',
        'expense_id',
        'user_id',
        'amount',
        'payment_method',
        'transaction_reference',
        'payment_date',
        'notes',
        'status',
        'currency',
        'custom_fields',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2',
        'custom_fields' => 'array',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function expense(): BelongsTo
    {
        return $this->belongsTo(Expense::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if this payment is for an invoice
     */
    public function isForInvoice(): bool
    {
        return $this->invoice_id !== null;
    }

    /**
     * Check if this payment is for an expense
     */
    public function isForExpense(): bool
    {
        return $this->expense_id !== null;
    }

    /**
     * Check if the payment is completed
     */
    public function isCompleted(): bool
    {
        return $this->status === PaymentStatus::COMPLETED->value;
    }

    /**
     * Check if the payment is pending
     */
    public function isPending(): bool
    {
        return $this->status === PaymentStatus::PENDING->value;
    }

    /**
     * Check if the payment failed
     */
    public function isFailed(): bool
    {
        return $this->status === PaymentStatus::FAILED->value;
    }
}
