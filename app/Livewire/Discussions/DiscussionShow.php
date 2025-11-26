<?php

namespace App\Livewire\Discussions;

use App\Models\Comment;
use App\Models\Discussion;
use App\Services\ActivityService;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
#[Title('Discussion')]
class DiscussionShow extends Component
{
    use WithFileUploads;

    public Discussion $discussion;
    public $newComment = '';
    public $attachments = [];
    public $replyingTo = null;
    public $replyContent = '';
    public $allAttachments = [];
    public $relatedDiscussions = [];
    public $limit = 20;

    protected $rules = [
        'newComment' => 'required|string',
        'attachments.*' => 'nullable|file|max:10240',  // Max 10MB
        'replyContent' => 'required|string',
    ];

    public function mount(Discussion $discussion): void
    {
        $this->discussion = $discussion->load([
            'user',
            'comments' => function ($query) {
                return $query->with([
                    'user',
                    'replies.user',
                    'replies.attachments',
                    'attachments'
                ]);
            },
            'attachments',
            'project',
            'phase'
        ]);

        // Load all attachments (from discussion and its comments)
        $this->loadAllAttachments();

        // Load related discussions
        $this->loadRelatedDiscussions();
    }

    public function addComment(): void
    {
        $this->validateOnly('newComment');

        $comment = Comment::create([
            'content' => $this->newComment,
            'discussion_id' => $this->discussion->id,
            'user_id' => Auth::id(),
        ]);

        // Process attachments if any
        if (!empty($this->attachments)) {
            foreach ($this->attachments as $attachment) {
                if ($attachment && method_exists($attachment, 'getClientOriginalName')) {
                    $this->processAttachment($attachment, $this->discussion->id, $comment->id);
                }
            }
        }

        // Reset form
        $this->newComment = '';
        $this->attachments = [];

        // Log activity
        $activityService = new ActivityService();
        $activityService->logCommentAdded($comment);

        // Notify mentioned users
        // Using the method from the trait - need to call it properly
        $mentionedUsers = $this->parseMentions($comment->content);
        foreach ($mentionedUsers as $mentionedUser) {
            if ($mentionedUser['id'] != Auth::id()) {
                // Create notification for mentioned user
                $activityService->logActivity(
                    'user_mentioned',
                    'You were mentioned by ' . Auth::user()->name . ' in a comment',
                    $this->discussion,
                    [
                        'mentioned_by' => Auth::id(),
                        'content' => $comment->content,
                        'comment_id' => $comment->id,
                        'mentioned_user' => $mentionedUser['id']
                    ]
                );
            }
        }

        // Refresh the discussion to include the new comment
        $this->discussion->load(['user', 'comments.user', 'comments.replies.user', 'attachments']);
    }

    public function startReply($commentId): void
    {
        $this->replyingTo = $commentId;
        $this->replyContent = '';
    }

    public function cancelReply(): void
    {
        $this->replyingTo = null;
        $this->replyContent = '';
    }

    public function replyToComment(): void
    {
        $this->validateOnly('replyContent');

        $parentComment = Comment::find($this->replyingTo);
        if (!$parentComment) {
            return;
        }

        $comment = Comment::create([
            'content' => $this->replyContent,
            'discussion_id' => $this->discussion->id,
            'user_id' => Auth::id(),
            'parent_id' => $parentComment->id,
        ]);

        // Log activity
        $activityService = new ActivityService();
        $activityService->logCommentAdded($comment);

        // Process attachments if any
        if (!empty($this->attachments)) {
            foreach ($this->attachments as $attachment) {
                if ($attachment && method_exists($attachment, 'getClientOriginalName')) {
                    $this->processAttachment($attachment, $this->discussion->id, $comment->id);
                }
            }
        }

        // Notify mentioned users
        $this->discussion->notifyMentionedUsers($comment->content, Auth::user(), 'comment', $comment);

        // Reset form
        $this->replyingTo = null;
        $this->replyContent = '';
        $this->attachments = [];

        // Refresh the discussion to include the new comment
        $this->discussion->load(['user', 'comments.user', 'comments.replies.user', 'attachments']);
    }

    private function processAttachment($file, $discussionId, $commentId = null): void
    {
        $fileUploadService = new FileUploadService();
        $fileUploadService->upload($file, Auth::id(), $discussionId, $commentId);
    }

    /**
     * Load all attachments (from discussion and its comments)
     */
    protected function loadAllAttachments(): void
    {
        // Get attachments for this discussion
        $discussionAttachments = $this->discussion->attachments;

        // Get attachments for all comments in this discussion
        $commentAttachments = collect();
        foreach ($this->discussion->comments as $comment) {
            // Check if the relationship is already loaded to avoid triggering lazy loading
            $attachments = $comment->getRelation('attachments') ?? collect();
            $commentAttachments = $commentAttachments->concat($attachments);
        }

        $this->allAttachments = $discussionAttachments->concat($commentAttachments);
    }

    /**
     * Load related discussions
     */
    protected function loadRelatedDiscussions(): void
    {
        // Find related discussions based on the same project
        $this->relatedDiscussions = Discussion::where('project_id', $this->discussion->project_id)
            ->where('id', '!=', $this->discussion->id)  // Exclude current discussion
            ->orderBy('created_at', 'desc')
            ->limit($this->limit)
            ->get();
    }

    /**
     * Parse mentions from content and return the mentioned users
     */
    protected function parseMentions(string $content): array
    {
        $pattern = '/@(\w+)/';
        preg_match_all($pattern, $content, $matches);

        if (empty($matches[1])) {
            return [];
        }

        $mentionedUsernames = array_unique($matches[1]);
        $mentionedUsers = \App\Models\User::whereIn('name', $mentionedUsernames)->get();

        return $mentionedUsers->toArray();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $typeColors = [
            'project' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
            'task' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
            'client' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400',
        ];

        return view('livewire.discussions.discussion-show', [
            'typeColors' => $typeColors
        ]);
    }

    public function updatedAttachments(): void
    {
        // Validate each attachment as it's added
        $this->validateOnly('attachments.*');
    }
}
