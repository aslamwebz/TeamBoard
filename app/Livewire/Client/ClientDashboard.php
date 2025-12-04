<?php

declare(strict_types=1);

namespace App\Livewire\Client;

use App\Models\Client;
use App\Models\Discussion;
use Livewire\Component;
use Illuminate\View\View;

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
    public $latestFileDate = null;
    public $projectRequestsCount = 0;
    public $pendingProjectRequestsCount = 0;

    public function mount(): void
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData(): void
    {
        $user = auth()->user();
        $client = $this->getClientForUser($user);

        if (!$client) {
            return;
        }

        // Load project progress for the client
        $this->projectProgress = $client->projects()
            ->with(['tasks', 'phases', 'milestones'])
            ->get()
            ->map(function ($project) {
                $completedTasks = $project->tasks->where('status', 'completed')->count();
                $totalTasks = $project->tasks->count();

                return [
                    'id' => $project->id,
                    'name' => $project->name,
                    'progress' => $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0,
                    'status' => $project->status,
                ];
            })
            ->toArray();

        // Load invoices for the client and compute related statistics
        $invoicesCollection = $client->invoices()
            ->latest()
            ->take(5)
            ->get();

        $this->invoices = $invoicesCollection->toArray();

        // Calculate outstanding invoices statistics
        $outstandingInvoices = $client->invoices()->where('status', '!=', 'paid')->get();
        $this->outstandingInvoicesCount = $outstandingInvoices->count();
        $this->outstandingAmount = $outstandingInvoices->sum('amount');

        // Load files for the client (from attachments or discussions)
        // Placeholder - would load actual files in real implementation
        $this->files = [];
        $this->filesCount = count($this->files);
        $this->latestFileDate = !empty($this->files) ? $this->files[0]['created_at'] ?? null : null;

        // Load project requests (discussions or requests related to client)
        $projectRequestsCollection = Discussion::query()
            ->where('user_id', $user->id)
            ->orWhereHas('project', function ($query) use ($client) {
                $query->where('client_id', $client->id);
            })
            ->latest()
            ->take(5)
            ->get();

        $this->projectRequests = $projectRequestsCollection->toArray();
        $this->projectRequestsCount = $projectRequestsCollection->count();
        $this->pendingProjectRequestsCount = $projectRequestsCollection->where('status', 'pending')->count();

        // Load team activity related to client's projects
        $this->teamActivity = []; // Placeholder - would load actual activity in real implementation

        $this->clientInfo = [
            'name' => $client->company_name ?? $client->name,
            'email' => $client->email,
            'phone' => $client->phone,
        ];
    }

    private function getClientForUser($user): ?Client
    {
        return $user->clients()->first() ?? Client::where('email', $user->email)->first();
    }

    public function render(): View
    {
        return view('livewire.client.client-dashboard');
    }
}