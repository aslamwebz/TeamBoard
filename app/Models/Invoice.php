<?php declare(strict_types=1);

namespace App\Models;

use App\Helpers\TenantHelper;
use App\Models\Task;
use App\Models\Project;
use App\Models\Client;
use App\Models\User;
use App\Models\InvoiceLineItem;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

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

    protected $casts = [
        'issue_date' => 'date',
        'due_date' => 'date',
        'amount' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public const STATUS_DRAFT = 'draft';
    public const STATUS_SENT = 'sent';
    public const STATUS_PAID = 'paid';
    public const STATUS_OVERDUE = 'overdue';
    public const STATUS_CANCELLED = 'cancelled';

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
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
