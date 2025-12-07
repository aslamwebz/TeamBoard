<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\PhaseStatus;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

final class ProjectPhase extends Model
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
                return $this->status === PhaseStatus::COMPLETED->value ? 100 : 0;
            }

            return 0;
        }

        $completedTasks = $tasks->filter(function ($task) {
            return $task->status === TaskStatus::COMPLETED->value;
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
            if ($this->end_date && $this->end_date->isPast() && $this->status !== PhaseStatus::COMPLETED->value) {
                return PhaseStatus::ON_HOLD->value;  // Phase is past due without tasks completed
            }

            return $this->status;  // Return current status if no tasks
        }

        $completedTasks = $tasks->filter(function ($task) {
            return $task->status === TaskStatus::COMPLETED->value;
        });

        if ($completedTasks->count() === $tasks->count()) {
            return PhaseStatus::COMPLETED->value;
        }
        if ($completedTasks->count() > 0) {
            return PhaseStatus::IN_PROGRESS->value;
        }
        // If tasks exist but none are completed, check if phase should be in progress based on dates
        if ($this->start_date && $this->start_date->isPast() && $this->end_date && $this->end_date->isFuture()) {
            return PhaseStatus::IN_PROGRESS->value;
        }

        return PhaseStatus::NOT_STARTED->value;
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
