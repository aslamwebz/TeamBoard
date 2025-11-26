<?php

declare(strict_types=1);

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class ActivityTimeline extends Component
{
    public Client $client;
    public $activities = [];

    public function mount(Client $client) : void
    {
        $this->client = $client;
        $this->activities = $client->allActivities()
            ->with(['contact', 'creator'])
            ->latest()
            ->get();
    }

    public function render() : View
    {
        return view('livewire.clients.activity-timeline');
    }
}