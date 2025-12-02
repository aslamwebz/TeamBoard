<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'position',
        'job_title',
        'department',
        'work_phone',
        'mobile_phone',
        'linkedin_url',
        'twitter_handle',
        'notes',
        'is_primary',
        'is_billing_contact',
        'is_technical_contact',
        'communication_preferences',
        'client_id',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'is_billing_contact' => 'boolean',
        'is_technical_contact' => 'boolean',
        'communication_preferences' => 'array',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function activities(): HasMany
    {
        return $this->hasMany(ContactActivity::class);
    }

    public function getFullNameAttribute(): string
    {
        return mb_trim($this->first_name.' '.$this->last_name);
    }
}
