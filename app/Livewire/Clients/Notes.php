<?php

declare(strict_types=1);

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;

class Notes extends Component
{
    public Client $client;
    
    public string $notes = '';

    public function mount(Client $client): void
    {
        $this->client = $client;
        $this->notes = $client->notes ?? '';
    }

    public function saveNotes(): void
    {
        $this->validate([
            'notes' => 'nullable|string'
        ]);

        $this->client->update(['notes' => $this->notes]);

        session()->flash('message', 'Notes updated successfully.');
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.clients.notes');
    }
}