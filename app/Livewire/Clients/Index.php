<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Clients')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $showDeleteModal = false;
    public $confirmingDelete = false;
    public $clientToDeleteId;

    protected $queryString = ['search'];

    public function render()
    {
        $clients = Client::query()
            ->where(function ($query) {
                $query
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('company_name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.clients.index', [
            'clients' => $clients
        ]);
    }

    public function deleteClient($id)
    {
        $this->clientToDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function confirmDelete()
    {
        $client = Client::find($this->clientToDeleteId);
        if ($client) {
            $client->delete();
        }

        $this->showDeleteModal = false;
        $this->clientToDeleteId = null;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->clientToDeleteId = null;
    }
}
