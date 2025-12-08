<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TaskStatus;
use App\Helpers\TenantHelper;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $status
 * @property CarbonInterface|null $due_date
 * @property int|null $project_id
 * @property int|null $project_phase_id
 * @property array|null $dependencies
 * @property int $order
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class Task extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'project_id',
        'project_phase_id',
        'dependencies',
        'order',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date',
        'dependencies' => 'array',
    ];

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
        return $this->belongsToMany(User::class, 'user_tasks', 'task_id', 'user_id');
    }

    /**
     * Get the primary user assigned to this task
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get tasks that this task depends on
     */
    public function getDependentTasks()
    {
        $dependencies = is_string($this->dependencies) ? json_decode($this->dependencies, true) : $this->dependencies;

        return $this->whereIn('id', $dependencies ?? []);
    }

    /**
     * Check if this task has any dependencies
     */
    public function hasDependencies(): bool
    {
        $dependencies = is_string($this->dependencies) ? json_decode($this->dependencies, true) : $this->dependencies;

        return !empty($dependencies) && count($dependencies) > 0;
    }

    /**
     * Check if all dependencies are completed
     */
    public function areDependenciesCompleted(): bool
    {
        if (!$this->hasDependencies()) {
            return true;  // No dependencies means it can be started
        }

        $dependencies = is_string($this->dependencies) ? json_decode($this->dependencies, true) : $this->dependencies;
        $dependencyTasks = self::whereIn('id', $dependencies)->get();

        foreach ($dependencyTasks as $dependencyTask) {
            if ($dependencyTask->status !== TaskStatus::COMPLETED->value) {
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
        $dependencies = array_filter($dependencies, function ($id) use ($taskId) {
            return $id !== $taskId;
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
            Discussion::class,
            Project::class,
            'id',  // Foreign key on projects table
            'type_id',  // Foreign key on discussions table
            'project_id',  // Local key on tasks table
            'id'  // Local key on projects table
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
        return $this
            ->belongsToMany(WorkerProfile::class, 'timesheets', 'task_id', 'worker_profile_id')
            ->withPivot('hours_worked', 'entry_type', 'date')
            ->withTimestamps();
    }
}
