<?php

namespace App\Models;

use App\Models\User;
use App\Models\Skill;
use App\Models\Certification;
use App\Models\Timesheet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WorkerProfile extends Model
{
    use HasFactory;

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

    protected $casts = [
        'hire_date' => 'date',
        'hourly_rate' => 'decimal:2',
        'availability' => 'array',
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