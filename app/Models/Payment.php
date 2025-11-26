<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
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

    // Payment statuses
    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_FAILED = 'failed';
    public const STATUS_REFUNDED = 'refunded';
    public const STATUS_CANCELLED = 'cancelled';

    // Payment methods
    public const PAYMENT_CASH = 'cash';
    public const PAYMENT_CREDIT_CARD = 'credit_card';
    public const PAYMENT_DEBIT_CARD = 'debit_card';
    public const PAYMENT_BANK_TRANSFER = 'bank_transfer';
    public const PAYMENT_CHECK = 'check';
    public const PAYMENT_PAYPAL = 'paypal';
    public const PAYMENT_STRIPE = 'stripe';
    public const PAYMENT_OTHER = 'other';

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
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Check if the payment is pending
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if the payment failed
     */
    public function isFailed(): bool
    {
        return $this->status === self::STATUS_FAILED;
    }
}