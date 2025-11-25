<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\Discussion;
use App\Models\Comment;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ActivityService
{
    public function logActivity(string $action, string $description = null, $relatedModel = null, array $metadata = []): ActivityLog
    {
        $activityData = [
            'action' => $action,
            'description' => $description,
            'user_id' => Auth::id(),
            'metadata' => $metadata,
        ];

        if ($relatedModel) {
            $activityData['type'] = class_basename($relatedModel);
            $activityData['type_id'] = $relatedModel->id;
        }

        return ActivityLog::create($activityData);
    }

    public function logDiscussionCreated(Discussion $discussion): ActivityLog
    {
        return $this->logActivity(
            'created_discussion',
            "Created discussion: {$discussion->title}",
            $discussion,
            [
                'title' => $discussion->title,
                'content' => $discussion->content,
            ]
        );
    }

    public function logCommentAdded(Comment $comment): ActivityLog
    {
        $discussion = $comment->discussion;

        return $this->logActivity(
            'commented',
            "Added a comment to discussion: {$discussion->title}",
            $comment->discussion,
            [
                'comment_content' => $comment->content,
                'comment_id' => $comment->id,
                'discussion_title' => $discussion->title,
            ]
        );
    }

    public function logTaskUpdated(Task $task, array $changes): ActivityLog
    {
        return $this->logActivity(
            'updated_task',
            "Updated task: {$task->title}",
            $task,
            [
                'task_title' => $task->title,
                'changes' => $changes,
            ]
        );
    }

    public function logTaskCompleted(Task $task): ActivityLog
    {
        return $this->logActivity(
            'completed_task',
            "Completed task: {$task->title}",
            $task,
            [
                'task_title' => $task->title,
            ]
        );
    }

    public function getActivitiesForModel($model, $limit = 20)
    {
        return ActivityLog::with('user')
            ->where('type', class_basename($model))
            ->where('type_id', $model->id)
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function getRecentActivities($limit = 20)
    {
        return \App\Models\ActivityLog::with('user')
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function getProjectActivities(Project $project, $limit = 20)
    {
        // Get activities related to the project itself plus related discussions and tasks
        return \App\Models\ActivityLog::with('user')
            ->where(function($query) use ($project) {
                $query->where(function($q) use ($project) {
                    $q->where('type', 'Project')
                      ->where('type_id', $project->id);
                })
                ->orWhere(function($q) use ($project) {
                    $q->where('type', 'Discussion')
                      ->whereIn('type_id', $project->discussions()->pluck('id'));
                })
                ->orWhere(function($q) use ($project) {
                    $q->where('type', 'Task')
                      ->whereIn('type_id', $project->tasks()->pluck('id'));
                })
                ->orWhere(function($q) use ($project) {
                    $q->where('type', 'Comment')
                      ->whereIn('type_id', function($subQuery) use ($project) {
                          $subQuery->select('id')
                                   ->from('comments')
                                   ->whereIn('discussion_id', $project->discussions()->pluck('id'));
                      });
                });
            })
            ->latest()
            ->limit($limit)
            ->get();
    }
}