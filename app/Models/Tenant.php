<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Resolvers\DomainTenantResolver;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $fillable = [
        'legal_name', // This is the legal name
        'logo',
        'address',
        'phone',
        'email',
        'tax_vat_number',
        'industry',
        'currency',
        'timezone',
        'branding',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'branding' => 'array',
    ];

    /**
     * Accessor for the company legal name
     */
    public function legalName(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['legal_name'] ?? $attributes['name'] ?? null,
            set: fn ($value) => ['legal_name' => $value],
        );
    }

    /**
     * Accessor for the logo URL
     */
    public function logoUrl(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['logo'] ? Storage::url($attributes['logo']) : null,
        );
    }

    /**
     * Accessor for branding settings
     */
    public function brandingSettings(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value ?? '{}', true) ?: [],
        );
    }

    /**
     * Get the current tenant
     */
    public static function current(): ?self
    {
        try {
            return tenant();
        } catch (\Exception $e) {
            // If no tenant is set, return null
            return null;
        }
    }

    /**
     * Get the company name
     */
    public function getCompanyName(): string
    {
        return $this->legal_name ?? $this->id ?? 'Untitled Tenant';
    }

    /**
     * Get the default currency
     */
    public function getDefaultCurrency(): string
    {
        return $this->currency ?? 'USD';
    }

    /**
     * Get the default timezone
     */
    public function getDefaultTimezone(): string
    {
        return $this->timezone ?? 'UTC';
    }

    /**
     * Get branding configuration
     */
    public function getBrandingConfig(): array
    {
        return $this->branding ?? [];
    }

    /**
     * Get the primary contact email
     */
    public function getContactEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Get the company address
     */
    public function getCompanyAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Get the company phone number
     */
    public function getCompanyPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Get the tax/VAT number
     */
    public function getTaxVatNumber(): ?string
    {
        return $this->tax_vat_number;
    }

    /**
     * Get the company industry
     */
    public function getIndustry(): ?string
    {
        return $this->industry;
    }
}