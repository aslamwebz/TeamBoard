<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class VendorContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'position',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Get the vendor that owns the contact.
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the full name of the contact.
     */
    public function getFullNameAttribute(): string
    {
        return mb_trim($this->first_name.' '.$this->last_name);
    }
}
