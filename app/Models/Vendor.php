<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip_code
 * @property string|null $country
 * @property string|null $tax_id
 * @property string|null $description
 * @property float $rating
 * @property string|null $website
 * @property string $status
 * @property string|null $payment_terms
 * @property float $credit_limit
 * @property CarbonInterface|null $last_transaction_date
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class Vendor extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'tax_id',
        'description',
        'rating',
        'website',
        'status',
        'payment_terms',
        'credit_limit',
        'last_transaction_date',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'decimal:2',
        'credit_limit' => 'decimal:2',
        'last_transaction_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the vendor contacts.
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(VendorContact::class);
    }

    /**
     * Get the vendor services.
     */
    public function services(): HasMany
    {
        return $this->hasMany(VendorService::class);
    }

    /**
     * Get the vendor invoices.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(VendorInvoice::class);
    }

    /**
     * Get the purchase orders for this vendor.
     */
    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    /**
     * Get the projects assigned to this vendor.
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get the tasks assigned to this vendor.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the vendor invoices associated with projects.
     */
    public function projectInvoices(): HasMany
    {
        return $this->hasMany(VendorInvoice::class)->whereNotNull('project_id');
    }
}
