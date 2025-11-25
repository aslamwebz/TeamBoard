<?php

declare(strict_types=1);

namespace App\Livewire\Clients;

use App\Models\Client;
use App\Models\ContactActivity;
use Livewire\Component;

class ActivityTimeline extends Component
{
    public Client $client;
    public $activities = [];

    public function mount(Client $client)
    {
        $this->client = $client;
        $this->activities = $client->allActivities()
            ->with(['contact', 'creator'])
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.clients.activity-timeline');
    }
}