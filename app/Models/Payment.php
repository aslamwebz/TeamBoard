<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\PaymentMethod;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

final class Payment extends Model
{
    use HasFactory;

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
