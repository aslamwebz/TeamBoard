<?php declare(strict_types=1);

namespace App\Models;

use App\Helpers\TenantHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'project_id',
        'project_phase_id',
        'user_id',
        'dependencies',
        'order',
    ];

    protected $casts = [
        'due_date' => 'date',
        'dependencies' => 'array',
    ];

    // Define task statuses
    public const STATUS_TODO = 'todo';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_ON_HOLD = 'on_hold';

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function phase(): BelongsTo
    {
        return $this->belongsTo(ProjectPhase::class, 'project_phase_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the dependent tasks for this task
     */
    public function getDependentTasks()
    {
        return $this->whereIn('id', $this->dependencies ?? []);
    }

    /**
     * Check if this task has any dependencies
     */
    public function hasDependencies(): bool
    {
        return !empty($this->dependencies) && count($this->dependencies) > 0;
    }

    /**
     * Check if all dependencies are completed
     */
    public function areDependenciesCompleted(): bool
    {
        if (!$this->hasDependencies()) {
            return true; // No dependencies means it can be started
        }

        $dependencyTasks = self::whereIn('id', $this->dependencies)->get();

        foreach ($dependencyTasks as $dependencyTask) {
            if ($dependencyTask->status !== self::STATUS_COMPLETED) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get tasks that depend on this task
     */
    public function getTaskDependents()
    {
        return self::whereJsonContains('dependencies', $this->id)->get();
    }

    /**
     * Add a dependency to this task
     */
    public function addDependency($taskId)
    {
        $dependencies = $this->dependencies ?? [];
        if (!in_array($taskId, $dependencies)) {
            $dependencies[] = $taskId;
            $this->update(['dependencies' => $dependencies]);
        }
    }

    /**
     * Remove a dependency from this task
     */
    public function removeDependency($taskId)
    {
        $dependencies = $this->dependencies ?? [];
        $dependencies = array_filter($dependencies, function($id) use ($taskId) {
            return $id != $taskId;
        });
        $this->update(['dependencies' => array_values($dependencies)]);
    }

    /**
     * Get all potential dependencies for this task (tasks in the same project that are not this task)
     */
    public function getPotentialDependencies()
    {
        return self::where('project_id', $this->project_id)
                    ->where('id', '!=', $this->id)
                    ->orderBy('order')
                    ->orderBy('created_at')
                    ->get();
    }

    /**
     * Get discussions related to this task
     */
    public function discussions()
    {
        return $this->hasManyThrough(
            \App\Models\Discussion::class,
            \App\Models\Project::class,
            'id', // Foreign key on projects table
            'type_id', // Foreign key on discussions table
            'project_id', // Local key on tasks table
            'id' // Local key on projects table
        )->where('discussions.type', 'task');
    }

    /**
     * Get the company name associated with this task
     */
    public function getCompanyName(): string
    {
        return TenantHelper::getCompanyName() ?? config('app.name', 'App Name');
    }

    /**
     * Get the default currency for this task
     */
    public function getDefaultCurrency(): string
    {
        return TenantHelper::getDefaultCurrency();
    }

    /**
     * Get the worker assigned to this task through timesheets
     */
    public function worker()
    {
        return $this->belongsToMany(WorkerProfile::class, 'timesheets', 'task_id', 'worker_profile_id')
                    ->withPivot('hours_worked', 'entry_type', 'date')
                    ->withTimestamps();
    }
}
