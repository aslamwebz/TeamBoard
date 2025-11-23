<?php declare(strict_types=1);

namespace App\Models;

use App\Traits\HasMentions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, HasMentions;

    protected $fillable = [
        'content',
        'discussion_id',
        'user_id',
        'parent_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function discussion(): BelongsTo
    {
        return $this->belongsTo(Discussion::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(DiscussionAttachment::class);
    }

    /**
     * Get all attachments for this comment
     */
    public function getAttachments()
    {
        return $this->attachments()->with('user')->get();
    }

    /**
     * Check if this comment has any replies
     */
    public function hasReplies(): bool
    {
        return $this->replies()->count() > 0;
    }

    /**
     * Get all replies recursively with users and attachments
     */
    public function getRepliesRecursive()
    {
        return $this->replies()->with(['user', 'attachments', 'replies'])->get();
    }

    /**
     * Format content with mentions
     */
    public function formatContentWithMentions()
    {
        $pattern = '/@(\w+)/';

        return preg_replace_callback($pattern, function ($matches) {
            $username = $matches[1];
            $user = User::where('name', $username)->first();

            if ($user) {
                return "<a href='/users/{$user->id}' class='text-blue-600 hover:underline'>@{$username}</a>";
            }

            return $matches[0]; // Return original if user not found
        }, $this->content);
    }
}