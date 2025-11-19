<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'vat_number',
        'logo',
        'registration_number',
        'tax_id',
        'website',
        'industry',
        'description',
        'billing_plan',
        'subscription_start_date',
        'subscription_end_date',
        'subscription_status',
        'notes',
        'billing_address',
        'shipping_address',
        'primary_contact_id',
        'custom_fields',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'subscription_start_date' => 'datetime',
        'subscription_end_date' => 'datetime',
        'custom_fields' => 'array',
        'notes' => 'string',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function primaryContact(): BelongsTo
    {
        return $this->belongsTo(Contact::class, 'primary_contact_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(ClientAttachment::class);
    }

    public function allActivities()
    {
        // Get activities for all contacts of this client
        return $this->hasManyThrough(ContactActivity::class, Contact::class);
    }
}
