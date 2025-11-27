<?php

namespace App\Livewire\Client;

use App\Models\Project;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Discussion;
use App\Models\User;
use Livewire\Component;

class ClientDashboard extends Component
{
    public $projectProgress = [];
    public $invoices = [];
    public $files = [];
    public $projectRequests = [];
    public $teamActivity = [];
    public $clientInfo = [];

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        $user = auth()->user();
        
        // Get the client associated with this user
        $client = $this->getClientForUser($user);
        
        if ($client) {
            // Load project progress for the client
            $this->projectProgress = $client->projects()
                ->with(['tasks', 'phases', 'milestones'])
                ->get()
                ->map(function ($project) {
                    return [
                        'id' => $project->id,
                        'name' => $project->name,
                        'progress' => $project->getCompletionPercentage(),
                        'status' => $project->status,
                        'due_date' => $project->due_date,
                        'tasks_completed' => $project->tasks->where('status', 'completed')->count(),
                        'total_tasks' => $project->tasks->count(),
                    ];
                });

            // Load invoices for the client
            $this->invoices = $client->invoices()
                ->latest()
                ->take(5)
                ->get();

            // Load files for the client (from attachments or discussions)
            $this->files = collect(); // Placeholder - would load actual files in real implementation

            // Load project requests (discussions or requests related to client)
            $this->projectRequests = Discussion::where('user_id', $user->id)
                ->orWhereHas('project', function($query) use ($client) {
                    $query->where('client_id', $client->id);
                })
                ->latest()
                ->take(5)
                ->get();

            // Load team activity related to client's projects
            $this->teamActivity = collect(); // Placeholder - would load actual activity in real implementation
            
            $this->clientInfo = [
                'name' => $client->company_name ?? $client->name,
                'email' => $client->email,
                'phone' => $client->phone,
            ];
        }
    }

    private function getClientForUser($user)
    {
        // Check if the user is directly associated with any clients
        if ($user->clients()->exists()) {
            return $user->clients()->first();
        }

        // If not found through user_clients, try getting client through projects
        $project = $user->projects()->first();
        if ($project && $project->client) {
            return $project->client;
        }

        // For demo purposes, just return the first client
        return Client::first();
    }

    public function render()
    {
        return view('livewire.client.client-dashboard');
    }
}