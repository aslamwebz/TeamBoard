<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $vendor_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $position
 * @property bool $is_primary
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class VendorContact extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'vendor_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'position',
        'is_primary',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_primary' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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
