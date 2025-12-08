<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ExpenseStatus;
use App\Enums\PaymentStatus;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property string $name
 * @property int|null $expense_category_id
 * @property int|null $project_id
 * @property int|null $vendor_id
 * @property int|null $user_id
 * @property string $title
 * @property string|null $description
 * @property float $amount
 * @property string $currency
 * @property CarbonInterface|null $expense_date
 * @property string $status
 * @property string|null $payment_method
 * @property string|null $notes
 * @property string|null $receipt_path
 * @property int|null $approver_id
 * @property CarbonInterface|null $approved_at
 * @property array|null $custom_fields
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class Expense extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
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

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2',
        'approved_at' => 'datetime',
        'custom_fields' => 'array',
    ];

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
        return $this->payments()->where('status', PaymentStatus::COMPLETED->value)->sum('amount');
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
        return $this->status === ExpenseStatus::PENDING->value;
    }

    /**
     * Check if the expense is approved
     */
    public function isApproved(): bool
    {
        return $this->status === ExpenseStatus::APPROVED->value || $this->status === ExpenseStatus::PAID->value;
    }

    /**
     * Get the receipt URL if available
     */
    public function getReceiptUrl()
    {
        if ($this->receipt_path) {
            return Storage::url($this->receipt_path);
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
