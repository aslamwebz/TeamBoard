<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string|null $company_name
 * @property string|null $name
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip_code
 * @property string|null $country
 * @property string|null $vat_number
 * @property string|null $logo
 * @property string|null $registration_number
 * @property string|null $tax_id
 * @property string|null $website
 * @property string|null $industry
 * @property string|null $description
 * @property string|null $billing_plan
 * @property CarbonInterface|null $subscription_start_date
 * @property CarbonInterface|null $subscription_end_date
 * @property string|null $subscription_status
 * @property string|null $notes
 * @property string|null $billing_address
 * @property string|null $shipping_address
 * @property int|null $primary_contact_id
 * @property array|null $custom_fields
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class Client extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
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

    /**
     * @var array<string, string>
     */
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
