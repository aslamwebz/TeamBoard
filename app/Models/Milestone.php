<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PhaseStatus;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $project_id
 * @property int|null $project_phase_id
 * @property CarbonInterface|null $due_date
 * @property string $status
 * @property int $order
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class Milestone extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'description',
        'project_id',
        'project_phase_id',
        'due_date',
        'status',
        'order',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function phase(): BelongsTo
    {
        return $this->belongsTo(ProjectPhase::class, 'project_phase_id');
    }

    /**
     * Check if this milestone is overdue
     */
    public function isOverdue(): bool
    {
        return $this->due_date && $this->due_date->isPast() && $this->status !== PhaseStatus::COMPLETED->value;
    }

    /**
     * Check if this milestone is upcoming
     */
    public function isUpcoming(): bool
    {
        return $this->due_date && $this->due_date->isFuture();
    }
}
