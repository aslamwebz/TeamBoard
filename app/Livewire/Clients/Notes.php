<?php

declare(strict_types=1);

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;

class Notes extends Component
{
    public Client $client;
    
    public string $notes = '';

    public function mount(Client $client)
    {
        $this->client = $client;
        $this->notes = $client->notes ?? '';
    }

    public function saveNotes()
    {
        $this->validate([
            'notes' => 'nullable|string'
        ]);
        
        $this->client->update(['notes' => $this->notes]);
        
        session()->flash('message', 'Notes updated successfully.');
    }

    public function render()
    {
        return view('livewire.clients.notes');
    }
}