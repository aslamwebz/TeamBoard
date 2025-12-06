<?php declare(strict_types=1);

namespace App\Livewire\Clients;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Clients')]
final class ClientIndex extends Component
{
    use WithPagination;

    public $search = '';

    public $showDeleteModal = false;

    public $clientToDeleteId;

    protected $queryString = ['search'];

    public function render(): View
    {
        $clientsQuery = Client::query()
            ->where(function ($query) {
                $query
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('company_name', 'like', '%' . $this->search . '%');
            });

        // Add subqueries for project counts
        $clients = $clientsQuery
            ->withCount(['projects', 'projects as active_projects' => function ($query) {
                $query->whereIn('status', ['planning', 'in_progress']);
            }])
            ->selectRaw('clients.*,
                (SELECT COUNT(tasks.id)
                 FROM projects
                 LEFT JOIN tasks ON projects.id = tasks.project_id
                 WHERE projects.client_id = clients.id) as total_tasks,
                 (SELECT COUNT(tasks.id)
                  FROM projects
                  LEFT JOIN tasks ON projects.id = tasks.project_id
                  WHERE projects.client_id = clients.id AND tasks.status = "completed") as completed_tasks')
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.clients.client-index', [
            'clients' => $clients,
        ]);
    }

    public function deleteClient($id): void
    {
        $this->clientToDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function confirmDelete(): void
    {
        $client = Client::find($this->clientToDeleteId);
        if ($client) {
            $client->delete();
        }

        $this->showDeleteModal = false;
        $this->clientToDeleteId = null;
    }

    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->clientToDeleteId = null;
    }
}
