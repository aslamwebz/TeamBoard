<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class ProjectPhase extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'project_id',
        'start_date',
        'end_date',
        'status',
        'order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define phase statuses
    public const STATUS_NOT_STARTED = 'not_started';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_ON_HOLD = 'on_hold';

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_phase_id');
    }

    public function milestones(): HasMany
    {
        return $this->hasMany(Milestone::class);
    }

    /**
     * Get the percentage completed for this phase based on tasks
     */
    public function getCompletionPercentage(): int
    {
        $tasks = $this->tasks;
        if ($tasks->count() === 0) {
            // If no tasks, check if phase has been started based on dates
            if ($this->start_date && $this->start_date->isPast()) {
                return $this->status === self::STATUS_COMPLETED ? 100 : 0;
            }
            return 0;
        }

        $completedTasks = $tasks->filter(function ($task) {
            return $task->status === Task::STATUS_COMPLETED;
        });

        return (int) round(($completedTasks->count() / $tasks->count()) * 100);
    }

    /**
     * Determine phase status based on tasks and dates
     */
    public function getCalculatedStatus(): string
    {
        $tasks = $this->tasks;

        if ($tasks->count() === 0) {
            // If no tasks, determine by dates
            if ($this->end_date && $this->end_date->isPast() && $this->status !== self::STATUS_COMPLETED) {
                return self::STATUS_ON_HOLD; // Phase is past due without tasks completed
            }
            return $this->status; // Return current status if no tasks
        }

        $completedTasks = $tasks->filter(function ($task) {
            return $task->status === Task::STATUS_COMPLETED;
        });

        if ($completedTasks->count() === $tasks->count()) {
            return self::STATUS_COMPLETED;
        } elseif ($completedTasks->count() > 0) {
            return self::STATUS_IN_PROGRESS;
        } else {
            // If tasks exist but none are completed, check if phase should be in progress based on dates
            if ($this->start_date && $this->start_date->isPast() && $this->end_date && $this->end_date->isFuture()) {
                return self::STATUS_IN_PROGRESS;
            }
            return self::STATUS_NOT_STARTED;
        }
    }

    /**
     * Update the phase status based on tasks
     */
    public function updateStatusFromTasks(): string
    {
        $calculatedStatus = $this->getCalculatedStatus();
        $this->update(['status' => $calculatedStatus]);
        return $calculatedStatus;
    }
}