<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_profile_id',
        'project_id',
        'task_id',
        'date',
        'hours_worked',
        'activity_description',
        'entry_type',
        'status',
        'approved_by',
        'approved_at',
        'notes',
    ];

    protected $casts = [
        'hours_worked' => 'decimal:2',
        'date' => 'date',
        'approved_at' => 'datetime',
    ];

    /**
     * Get the worker profile that owns the timesheet entry.
     */
    public function workerProfile(): BelongsTo
    {
        return $this->belongsTo(WorkerProfile::class);
    }

    /**
     * Get the project associated with this timesheet.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the task associated with this timesheet.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Get the user who approved this timesheet.
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Check if the timesheet entry is approved.
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if the timesheet entry is pending approval.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the timesheet entry is rejected.
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if the hours are overtime.
     */
    public function isOvertime(): bool
    {
        return $this->entry_type === 'overtime';
    }

    /**
     * Check if the entry is a leave type (vacation, sick, etc.).
     */
    public function isLeave(): bool
    {
        return in_array($this->entry_type, ['vacation', 'sick_leave', 'holiday']);
    }
}