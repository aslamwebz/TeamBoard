<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'description',
        'type',
        'type_id',
        'user_id',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the related model instance (project, task, etc.)
     */
    public function getRelatedModel()
    {
        if (!$this->type || !$this->type_id) {
            return null;
        }

        $modelClass = "App\\Models\\{$this->type}";
        
        if (class_exists($modelClass)) {
            return $modelClass::find($this->type_id);
        }

        return null;
    }

    /**
     * Get a human-readable description of the action
     */
    public function getHumanDescription(): string
    {
        if ($this->description) {
            return $this->description;
        }

        // Generate a default description based on the action
        $actionDescriptions = [
            'created_discussion' => 'created a new discussion',
            'commented' => 'added a comment',
            'uploaded_file' => 'uploaded a file',
            'updated_task' => 'updated a task',
            'completed_task' => 'completed a task',
            'assigned_task' => 'assigned a task',
            'user_mentioned' => 'was mentioned in a discussion',
        ];

        return $actionDescriptions[$this->action] ?? $this->action;
    }
}