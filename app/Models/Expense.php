<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'expense_category_id',
        'project_id',
        'vendor_id',
        'user_id',
        'title',
        'description',
        'amount',
        'currency',
        'expense_date',
        'status',
        'payment_method',
        'notes',
        'receipt_path',
        'approver_id',
        'approved_at',
        'custom_fields',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2',
        'approved_at' => 'datetime',
        'custom_fields' => 'array',
    ];

    // Expense statuses
    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_PAID = 'paid';
    public const STATUS_CANCELLED = 'cancelled';

    // Payment methods
    public const PAYMENT_CASH = 'cash';
    public const PAYMENT_CREDIT_CARD = 'credit_card';
    public const PAYMENT_DEBIT_CARD = 'debit_card';
    public const PAYMENT_BANK_TRANSFER = 'bank_transfer';
    public const PAYMENT_CHECK = 'check';
    public const PAYMENT_PAYPAL = 'paypal';
    public const PAYMENT_OTHER = 'other';

    public function category(): BelongsTo
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'expense_id');
    }

    /**
     * Get the total amount paid for this expense
     */
    public function getTotalPaidAmount(): float
    {
        return $this->payments()->where('status', Payment::STATUS_COMPLETED)->sum('amount');
    }

    /**
     * Get the remaining balance for this expense
     */
    public function getRemainingBalance(): float
    {
        return $this->amount - $this->getTotalPaidAmount();
    }

    /**
     * Check if the expense is fully paid
     */
    public function isFullyPaid(): bool
    {
        return $this->getRemainingBalance() <= 0;
    }

    /**
     * Check if the expense is pending approval
     */
    public function isPendingApproval(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if the expense is approved
     */
    public function isApproved(): bool
    {
        return $this->status === self::STATUS_APPROVED || $this->status === self::STATUS_PAID;
    }

    /**
     * Get the receipt URL if available
     */
    public function getReceiptUrl()
    {
        if ($this->receipt_path) {
            return \Storage::url($this->receipt_path);
        }
        return null;
    }

    /**
     * Get all attachments for this expense
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(ExpenseAttachment::class);
    }
}