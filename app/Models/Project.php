<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\ProjectStatus;
use App\Helpers\TenantHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

final class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'due_date',
        'client_id',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function phases(): HasMany
    {
        return $this->hasMany(ProjectPhase::class)->orderBy('order');
    }

    public function milestones(): HasMany
    {
        return $this->hasMany(Milestone::class)->orderBy('order');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_projects', 'project_id', 'user_id');
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function teams(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_projects', 'project_id', 'team_id');
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * Get the company name associated with this project
     */
    public function getCompanyName(): string
    {
        return TenantHelper::getCompanyName() ?? config('app.name', 'App Name');
    }

    /**
     * Get the company address for this project
     */
    public function getCompanyAddress(): ?string
    {
        return TenantHelper::getCompanyAddress();
    }

    /**
     * Get the default currency for this project
     */
    public function getDefaultCurrency(): string
    {
        return TenantHelper::getDefaultCurrency();
    }

    /**
     * Get the project completion percentage based on phases
     */
    public function getCompletionPercentage(): int
    {
        $phases = $this->phases;
        if ($phases->count() === 0) {
            // If no phases, calculate based on tasks
            $tasks = $this->tasks;
            if ($tasks->count() === 0) {
                return 0;
            }

            $completedTasks = $tasks->filter(function ($task) {
                return $task->status === \App\Enums\TaskStatus::COMPLETED->value;
            });

            return (int) round(($completedTasks->count() / $tasks->count()) * 100);
        }

        $completedPhases = $phases->filter(function ($phase) {
            return $phase->status === \App\Enums\PhaseStatus::COMPLETED->value;
        });

        return (int) round(($completedPhases->count() / $phases->count()) * 100);
    }

    /**
     * Accessor for completion percentage
     */
    public function getGetCompletionPercentageAttribute(): int
    {
        return $this->getCompletionPercentage();
    }

    /**
     * Get the workers assigned to this project through timesheets
     */
    public function workers()
    {
        return $this
            ->belongsToMany(WorkerProfile::class, 'timesheets', 'project_id', 'worker_profile_id')
            ->withPivot('total_hours', 'entry_type')
            ->withTimestamps();
    }

    /**
     * Get discussions related to this project
     */
    public function projectDiscussions()
    {
        return $this->hasMany(Discussion::class, 'project_id');
    }

    /**
     * Alias for projectDiscussions for backward compatibility
     */
    public function discussions()
    {
        return $this->projectDiscussions();
    }

    /**
     * Get all discussions associated with this project's entities
     */
    public function getAllDiscussions()
    {
        // Get discussions directly associated with this project
        $projectDiscussions = $this->projectDiscussions;

        // Get discussions associated with tasks in this project
        $taskIds = $this->tasks()->pluck('id');
        $taskDiscussions = Discussion::where('type', 'task')
            ->whereIn('type_id', $taskIds)
            ->get();

        // Combine all discussions
        return $projectDiscussions->concat($taskDiscussions);
    }
}
