<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InvoiceStatus;
use App\Enums\PaymentStatus;
use App\Helpers\TenantHelper;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $client_id
 * @property int|null $project_id
 * @property string $invoice_number
 * @property CarbonInterface|null $issue_date
 * @property CarbonInterface|null $due_date
 * @property float $amount
 * @property float $tax
 * @property float $total
 * @property string $status
 * @property string|null $description
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class Invoice extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'client_id',
        'project_id',
        'invoice_number',
        'issue_date',
        'due_date',
        'amount',
        'tax',
        'total',
        'status',
        'description',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_invoices', 'invoice_id', 'user_id');
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Get the payment method for this invoice (if payment record exists).
     */
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method');
    }

    /**
     * Get the line items for this invoice.
     */
    public function lineItems()
    {
        return $this->hasMany(InvoiceLineItem::class, 'invoice_id');
    }

    /**
     * Get the payments for this invoice.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Calculate the total amount paid for this invoice.
     */
    public function getTotalPaidAmount(): float
    {
        return $this->payments()->where('status', PaymentStatus::COMPLETED->value)->sum('amount');
    }

    /**
     * Calculate the remaining balance for this invoice.
     */
    public function getRemainingBalance(): float
    {
        return max(0, $this->total - $this->getTotalPaidAmount());
    }

    /**
     * Calculate the payment percentage of this invoice.
     */
    public function getPaymentPercentage(): float
    {
        if ($this->total <= 0) {
            return 100.0;
        }

        $paid = $this->getTotalPaidAmount();

        return round(($paid / $this->total) * 100, 2);
    }

    /**
     * Check if the invoice is fully paid.
     */
    public function isFullyPaid(): bool
    {
        return $this->getRemainingBalance() <= 0;
    }

    /**
     * Check if the invoice is partially paid.
     */
    public function isPartiallyPaid(): bool
    {
        $totalPaid = $this->getTotalPaidAmount();

        return $totalPaid > 0 && $totalPaid < $this->total;
    }

    /**
     * Update the invoice status based on payment status.
     */
    public function updateStatusFromPayment(): string
    {
        if ($this->isFullyPaid()) {
            $this->status = InvoiceStatus::PAID->value;
        } elseif ($this->isPartiallyPaid()) {
            $this->status = InvoiceStatus::PARTIALLY_PAID->value;
        } elseif ($this->status === InvoiceStatus::DRAFT->value) {
            $this->status = InvoiceStatus::SENT->value;  // Default to sent when not drafted
        } elseif ($this->status === InvoiceStatus::SENT->value && $this->due_date->isPast()) {
            $this->status = InvoiceStatus::OVERDUE->value;
        }

        $this->save();

        return $this->status;
    }

    /**
     * Get the latest payment date for this invoice.
     */
    public function getLatestPaymentDate()
    {
        $latestPayment = $this->payments()->where('status', PaymentStatus::COMPLETED->value)->latest('payment_date')->first();

        return $latestPayment ? $latestPayment->payment_date : null;
    }

    /**
     * Get the company name for the invoice
     */
    public function getCompanyName(): string
    {
        return TenantHelper::getCompanyName() ?? config('app.name', 'App Name');
    }

    /**
     * Get the company address for the invoice
     */
    public function getCompanyAddress(): ?string
    {
        return TenantHelper::getCompanyAddress();
    }

    /**
     * Get the company email for the invoice
     */
    public function getCompanyEmail(): ?string
    {
        return TenantHelper::getCompanyEmail();
    }

    /**
     * Get the company phone for the invoice
     */
    public function getCompanyPhone(): ?string
    {
        return TenantHelper::getCompanyPhone();
    }

    /**
     * Get the company logo URL for the invoice
     */
    public function getCompanyLogo(): ?string
    {
        return TenantHelper::getCompanyLogo();
    }

    /**
     * Get the company tax/VAT number for the invoice
     */
    public function getCompanyTaxVatNumber(): ?string
    {
        return TenantHelper::getTaxVatNumber();
    }

    /**
     * Get the default currency for the invoice
     */
    public function getDefaultCurrency(): string
    {
        return TenantHelper::getDefaultCurrency();
    }
}
