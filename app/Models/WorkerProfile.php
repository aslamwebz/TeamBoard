<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string|null $employee_id
 * @property string|null $job_title
 * @property string|null $bio
 * @property float $hourly_rate
 * @property string|null $department
 * @property int|null $manager_id
 * @property CarbonInterface|null $hire_date
 * @property string|null $employment_type
 * @property string $status
 * @property array|null $availability
 * @property string|null $emergency_contact
 * @property string|null $emergency_contact_phone
 * @property string|null $address
 * @property string|null $city
 * @property string|null $state
 * @property string|null $zip_code
 * @property string|null $country
 * @property string|null $phone
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class WorkerProfile extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'employee_id',
        'job_title',
        'bio',
        'hourly_rate',
        'department',
        'manager_id',
        'hire_date',
        'employment_type',
        'status',
        'availability',
        'emergency_contact',
        'emergency_contact_phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'phone',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'hire_date' => 'date',
        'hourly_rate' => 'decimal:2',
        'availability' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user associated with this worker profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the manager for this worker.
     */
    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    /**
     * Get the skills associated with this worker profile.
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'worker_skills')
            ->withPivot('proficiency_level', 'notes')
            ->withTimestamps();
    }

    /**
     * Get the certifications associated with this worker profile.
     */
    public function certifications(): BelongsToMany
    {
        return $this->belongsToMany(Certification::class, 'worker_certifications')
            ->withPivot('date_obtained', 'expiry_date', 'status', 'notes', 'attachment_path')
            ->withTimestamps();
    }

    /**
     * Get the timesheets for this worker.
     */
    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }
}
