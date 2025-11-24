<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'hourly_rate' => 'decimal:2',
        'hire_date' => 'date',
        'availability' => 'array',
    ];

    /**
     * Get the user that owns the worker profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the skills for this worker.
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'worker_skills')
                    ->withPivot('proficiency_level', 'notes')
                    ->withTimestamps();
    }

    /**
     * Get the certifications for this worker.
     */
    public function certifications(): BelongsToMany
    {
        return $this->belongsToMany(Certification::class, 'worker_certifications')
                    ->withPivot('date_obtained', 'expiry_date', 'attachment_path', 'status', 'notes')
                    ->withTimestamps();
    }

    /**
     * Get the timesheets for this worker.
     */
    public function timesheets(): HasMany
    {
        return $this->hasMany(Timesheet::class);
    }

    /**
     * Get the projects assigned to this worker through timesheets.
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'timesheets');
    }

    /**
     * Get the tasks assigned to this worker through timesheets.
     */
    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'timesheets');
    }

    /**
     * Check if the worker is currently active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if the worker is on leave.
     */
    public function isOnLeave(): bool
    {
        return $this->status === 'on_leave';
    }

    /**
     * Calculate total hours worked for a given period.
     */
    public function getTotalHoursWorked($startDate = null, $endDate = null): float
    {
        $query = $this->timesheets()->where('entry_type', 'regular');
        
        if ($startDate) {
            $query->where('date', '>=', $startDate);
        }
        
        if ($endDate) {
            $query->where('date', '<=', $endDate);
        }
        
        return $query->sum('hours_worked');
    }

    /**
     * Calculate total overtime hours for a given period.
     */
    public function getTotalOvertimeHours($startDate = null, $endDate = null): float
    {
        $query = $this->timesheets()->where('entry_type', 'overtime');
        
        if ($startDate) {
            $query->where('date', '>=', $startDate);
        }
        
        if ($endDate) {
            $query->where('date', '<=', $endDate);
        }
        
        return $query->sum('hours_worked');
    }
}