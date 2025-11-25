<?php declare(strict_types=1);

namespace App\Models;

use App\Traits\HasMentions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory, HasMentions;

    protected $fillable = [
        'title',
        'content',
        'type',
        'type_id',
        'user_id',
        'project_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this
            ->hasMany(Comment::class, 'discussion_id')
            ->whereNull('parent_id')
            ->with(['user', 'attachments', 'replies' => function ($query) {
                $query->with(['user', 'attachments']);
            }])
            ->orderBy('created_at', 'asc');
    }

    public function allComments()
    {
        return $this
            ->hasMany(Comment::class)
            ->with(['user', 'attachments', 'replies' => function ($query) {
                $query->with(['user', 'attachments']);
            }])
            ->orderBy('created_at', 'asc');
    }

    /**
     * Get all attachments associated with this discussion and its comments
     */
    public function getAllAttachments()
    {
        // Eager load all necessary relationships
        $this->load([
            'attachments',
            'comments.attachments',
            'comments.replies.attachments'
        ]);

        // Get discussion attachments
        $discussionAttachments = $this->attachments;

        // Get attachments for all comments in this discussion
        $commentAttachments = collect();
        foreach ($this->comments as $comment) {
            $commentAttachments = $commentAttachments->concat($comment->attachments);
            foreach ($comment->replies as $reply) {
                $commentAttachments = $commentAttachments->concat($reply->attachments);
            }
        }

        return $discussionAttachments->concat($commentAttachments);
    }

    /**
     * Get all related discussions based on project
     */
    public function getRelatedDiscussions($limit = 5)
    {
        return self::where('project_id', $this->project_id)
            ->where('id', '!=', $this->id)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(DiscussionAttachment::class);
    }

    /**
     * Get all attachments for this discussion
     */
    public function getAttachments()
    {
        return $this->attachments()->with('user')->get();
    }

    /**
     * Get the project this discussion belongs to
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * Get the phase this discussion belongs to (if any)
     */
    public function phase(): BelongsTo
    {
        return $this->belongsTo(ProjectPhase::class, 'project_phase_id');
    }

    /**
     * Get the latest comment for this discussion
     */
    public function getLatestComment()
    {
        return $this->allComments()->latest()->first();
    }

    /**
     * Get the number of comments for this discussion
     */
    public function getCommentCount(): int
    {
        return $this->allComments()->count();
    }

    /**
     * Scope to get discussions for a specific type and ID
     */
    public function scopeOfType($query, $type, $typeId)
    {
        return $query->where('type', $type)->where('type_id', $typeId);
    }

    /**
     * Boot the model and set up event listeners
     */
    protected static function booted()
    {
        static::creating(function ($discussion) {
            // If type is project, set the project_id to the type_id
            if ($discussion->type === 'project') {
                $discussion->project_id = $discussion->type_id;
            }
            // If type is task, get the project ID from the task
            elseif ($discussion->type === 'task') {
                $task = \App\Models\Task::find($discussion->type_id);
                if ($task) {
                    $discussion->project_id = $task->project_id;
                }
            }
            // If type is client, we might want to associate with all related projects
            elseif ($discussion->type === 'client') {
                // For now, we'll leave project_id as null for client discussions
            }
        });

        static::updating(function ($discussion) {
            // Handle updates if needed
        });
    }

    /**
     * Format content with mentions
     */
    public function formatContentWithMentions($content = null)
    {
        $content = $content ?? $this->content;

        $pattern = '/@(\w+)/';

        return preg_replace_callback($pattern, function ($matches) {
            $username = $matches[1];
            $user = \App\Models\User::where('name', $username)->first();

            if ($user) {
                return "<a href='/users/{$user->id}' class='text-blue-600 hover:underline'>@{$username}</a>";
            }

            return $matches[0];  // Return original if user not found
        }, $content);
    }
}
