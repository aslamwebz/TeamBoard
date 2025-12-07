<?php declare(strict_types=1);

namespace App\Models;

use App\Enums\PhaseStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

final class Milestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'project_id',
        'project_phase_id',
        'due_date',
        'status',
        'order',
    ];

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
