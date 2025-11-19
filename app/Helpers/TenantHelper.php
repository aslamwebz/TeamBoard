<?php

namespace App\Helpers;

use App\Models\Tenant;

class TenantHelper
{
    /**
     * Get the current tenant's company name
     */
    public static function getCompanyName(): ?string
    {
        $tenant = Tenant::current();
        return $tenant?->getCompanyName();
    }

    /**
     * Get the current tenant's logo URL
     */
    public static function getCompanyLogo(): ?string
    {
        $tenant = Tenant::current();
        return $tenant?->logo_url;
    }

    /**
     * Get the current tenant's contact email
     */
    public static function getCompanyEmail(): ?string
    {
        $tenant = Tenant::current();
        return $tenant?->getContactEmail();
    }

    /**
     * Get the current tenant's phone number
     */
    public static function getCompanyPhone(): ?string
    {
        $tenant = Tenant::current();
        return $tenant?->getCompanyPhone();
    }

    /**
     * Get the current tenant's address
     */
    public static function getCompanyAddress(): ?string
    {
        $tenant = Tenant::current();
        return $tenant?->getCompanyAddress();
    }

    /**
     * Get the current tenant's default currency
     */
    public static function getDefaultCurrency(): string
    {
        $tenant = Tenant::current();
        return $tenant?->getDefaultCurrency() ?? 'USD';
    }

    /**
     * Get the current tenant's default timezone
     */
    public static function getDefaultTimezone(): string
    {
        $tenant = Tenant::current();
        return $tenant?->getDefaultTimezone() ?? 'UTC';
    }

    /**
     * Get the current tenant's branding configuration
     */
    public static function getBrandingConfig(): array
    {
        $tenant = Tenant::current();
        return $tenant?->getBrandingConfig() ?? [];
    }

    /**
     * Get the current tenant's tax/VAT number
     */
    public static function getTaxVatNumber(): ?string
    {
        $tenant = Tenant::current();
        return $tenant?->getTaxVatNumber();
    }

    /**
     * Get the current tenant's industry
     */
    public static function getIndustry(): ?string
    {
        $tenant = Tenant::current();
        return $tenant?->getIndustry();
    }
}