<?php

declare(strict_types=1);

namespace App\Livewire\Client;

use App\Models\Client;
use App\Models\Discussion;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

final class ClientDashboard extends Component
{
    public array $projectProgress = [];

    public array $invoices = [];

    public array $files = [];

    public array $projectRequests = [];

    public array $teamActivity = [];

    public array $clientInfo = [];

    public $outstandingInvoicesCount = 0;

    public $outstandingAmount = 0;

    public $filesCount = 0;

    public $latestFileDate;

    public $projectRequestsCount = 0;

    public $pendingProjectRequestsCount = 0;

    public $avgProjectProgress = 0;

    public function mount(): void
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData(): void
    {
        $user = Auth::user();
        $client = $this->getClientForUser($user);

        if (! $client instanceof Client) {
            return;
        }

        // Load project progress for the client
        $projectProgressCollection = $client
            ->projects()
            ->with(['tasks', 'phases', 'milestones'])
            ->get()
            ->map(function ($project): array {
                $completedTasks = $project->tasks->where('status', 'completed')->count();
                $totalTasks = $project->tasks->count();

                return [
                    'id' => $project->id,
                    'name' => $project->name,
                    'progress' => $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0,
                    'status' => $project->status,
                ];
            });

        $this->projectProgress = $projectProgressCollection->toArray();

        // Calculate average project progress
        $this->avgProjectProgress = $projectProgressCollection->count() > 0 ? $projectProgressCollection->avg('progress') : 0;

        // Load invoices for the client and compute related statistics
        $invoicesCollection = $client
            ->invoices()
            ->latest()
            ->take(5)
            ->get();

        $this->invoices = $invoicesCollection->toArray();

        // Calculate outstanding invoices statistics
        $outstandingInvoices = $client->invoices()->where('status', '!=', 'paid')->get();
        $this->outstandingInvoicesCount = $outstandingInvoices->count();
        $this->outstandingAmount = $outstandingInvoices->sum('amount');

        // Load files for the client (from attachments or discussions)
        collect();

        // Get files from client attachments
        $clientAttachments = \App\Models\ClientAttachment::where('client_id', $client->id)
            ->with('user')
            ->latest()
            ->get();

        // Get files from project discussions and comments
        $projectDiscussionFiles = \App\Models\DiscussionAttachment::whereNull('comment_id')
            ->whereHas('discussion.project', function ($query) use ($client): void {
                $query->where('client_id', $client->id);
            })
            ->with(['discussion.project', 'user'])
            ->latest()
            ->get();

        // Get files from project comments
        $commentFiles = \App\Models\DiscussionAttachment::whereNotNull('comment_id')
            ->whereHas('comment.discussion.project', function ($query) use ($client): void {
                $query->where('client_id', $client->id);
            })
            ->with(['comment.discussion.project', 'user'])
            ->latest()
            ->get();

        // Combine all files
        $allFiles = $clientAttachments->merge($projectDiscussionFiles)->merge($commentFiles);

        // Format files for display
        $this->files = $allFiles->map(function ($file): array {
            $fileName = $file->file_name ?? $file->name ?? 'Unknown File';
            $fileSize = $file->file_size ?? 0;
            $createdAt = $file->created_at;

            // Determine file source and related entity
            $source = 'Client';
            $relatedEntity = 'Direct Upload';

            if ($file instanceof \App\Models\DiscussionAttachment) {
                if ($file->discussion_id && ! $file->comment_id) {
                    $source = 'Discussion';
                    $relatedEntity = $file->discussion->title ?? 'Unknown Discussion';
                } elseif ($file->comment_id) {
                    $source = 'Comment';
                    $relatedEntity = $file->comment->discussion->title ?? 'Unknown Discussion';
                } else {
                    $source = 'Client';
                    $relatedEntity = 'Direct Upload';
                }
            }

            return [
                'id' => $file->id,
                'name' => $fileName,
                'size' => $this->formatFileSize($fileSize),
                'type' => pathinfo($fileName, PATHINFO_EXTENSION),
                'source' => $source,
                'related_entity' => $relatedEntity,
                'uploaded_by' => $file->user->name ?? 'Unknown',
                'created_at' => $createdAt->format('M d, Y H:i'),
                'raw_created_at' => $createdAt,
                'download_url' => $this->getFileDownloadUrl($file),
            ];
        })->sortByDesc('raw_created_at')->values()->all();

        $this->filesCount = count($this->files);
        $this->latestFileDate = $this->files === [] ? null : $this->files[0]['created_at'];

        // Load project requests (discussions or requests related to client)
        $projectRequestsCollection = Discussion::query()
            ->where('user_id', $user->id)
            ->orWhereHas('project', function ($query) use ($client): void {
                $query->where('client_id', $client->id);
            })
            ->latest()
            ->take(5)
            ->get();

        $this->projectRequests = $projectRequestsCollection->toArray();
        $this->projectRequestsCount = $projectRequestsCollection->count();
        $this->pendingProjectRequestsCount = $projectRequestsCollection->where('status', 'pending')->count();

        // Load team activity related to client's projects
        $teamActivities = \App\Models\ActivityLog::whereHas('project', function ($query) use ($client): void {
            $query->where('client_id', $client->id);
        })
            ->with(['user', 'project'])
            ->latest()
            ->limit(10)
            ->get();

        $this->teamActivity = $teamActivities->map(fn ($activity): array => [
            'id' => $activity->id,
            'description' => $activity->description ?? 'Activity recorded',
            'user' => $activity->user->name ?? 'System',
            'project' => $activity->project->name ?? 'Unknown Project',
            'type' => $activity->type ?? 'general',
            'created_at' => $activity->created_at->format('M d, Y H:i'),
            'time_ago' => $activity->created_at->diffForHumans(),
        ])->all();

        $this->clientInfo = [
            'name' => $client->company_name ?? $client->name,
            'email' => $client->email,
            'phone' => $client->phone,
        ];
    }

    public function render(): View
    {
        return view('livewire.client.client-dashboard');
    }

    private function getClientForUser($user): ?Client
    {
        return $user->clients()->first() ?? Client::where('email', $user->email)->first();
    }

    /**
     * Format file size in human readable format
     */
    private function formatFileSize($bytes): string
    {
        if ($bytes === 0) {
            return '0 Bytes';
        }

        $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= 1024 ** $pow;

        return round($bytes, 2).' '.$units[$pow];
    }

    /**
     * Get download URL for file attachment
     */
    private function getFileDownloadUrl($attachment): string
    {
        $filePath = $attachment->file_path ?? $attachment->path ?? null;

        if (! $filePath) {
            return '#';
        }

        return route('files.download', ['file' => $attachment->id]);
    }
}
