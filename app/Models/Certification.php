<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'issuing_organization',
        'license_number',
        'issue_date',
        'expiry_date',
        'credential_id',
        'credential_url',
        'description',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
    ];

    /**
     * Get the workers that have this certification.
     */
    public function workers(): BelongsToMany
    {
        return $this->belongsToMany(WorkerProfile::class, 'worker_certifications')
                    ->withPivot('date_obtained', 'expiry_date', 'attachment_path', 'status', 'notes')
                    ->withTimestamps();
    }

    /**
     * Check if the certification is expired.
     */
    public function isExpired(): bool
    {
        return $this->expiry_date && $this->expiry_date->isPast();
    }

    /**
     * Check if the certification is active (not expired and not in the future).
     */
    public function isActive(): bool
    {
        return !$this->isExpired() && (!$this->issue_date || $this->issue_date->lessThanOrEqualTo(now()));
    }

    /**
     * Get days until expiration.
     */
    public function daysToExpiration(): ?int
    {
        if (!$this->expiry_date) {
            return null;
        }
        
        return $this->expiry_date->diffInDays(now(), false);
    }
}