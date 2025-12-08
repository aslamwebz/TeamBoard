<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int|null $worker_profile_id
 * @property int|null $project_id
 * @property int|null $task_id
 * @property CarbonInterface $date
 * @property float $hours_worked
 * @property string|null $activity_description
 * @property string $entry_type
 * @property string $status
 * @property int|null $approved_by
 * @property CarbonInterface|null $approved_at
 * @property string|null $notes
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class Timesheet extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
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

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'hours_worked' => 'decimal:2',
        'approved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the worker profile associated with this timesheet.
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
}
