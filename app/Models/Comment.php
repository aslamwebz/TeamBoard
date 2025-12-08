<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\HasMentions;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $content
 * @property int|null $discussion_id
 * @property int|null $user_id
 * @property int|null $parent_id
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
final class Comment extends Model
{
    use HasFactory, HasMentions;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'content',
        'discussion_id',
        'user_id',
        'parent_id',
    ];

    /**
     * @var array<string, string>
     */
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
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
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
