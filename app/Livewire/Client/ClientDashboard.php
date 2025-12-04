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

        // Load invoices for the client
        $this->invoices = $client->invoices()
            ->latest()
            ->take(5)
            ->get()
            ->toArray();

        // Load files for the client (from attachments or discussions)
        $this->files = []; // Placeholder - would load actual files in real implementation

        // Load project requests (discussions or requests related to client)
        $this->projectRequests = Discussion::query()
            ->where('user_id', $user->id)
            ->orWhereHas('project', function ($query) use ($client) {
                $query->where('client_id', $client->id);
            })
            ->latest()
            ->take(5)
            ->get()
            ->toArray();

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