<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vendor extends Model
{
    use HasFactory;

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

    protected $casts = [
        'rating' => 'decimal:2',
        'credit_limit' => 'decimal:2',
        'last_transaction_date' => 'datetime',
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
        return $this->hasMany(VendorInvoice::class);
    }
}