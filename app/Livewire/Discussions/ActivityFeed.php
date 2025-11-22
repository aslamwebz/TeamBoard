<?php

namespace App\Livewire\Discussions;

use App\Models\ActivityLog;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Activity Feed')]
class ActivityFeed extends Component
{
    public $limit = 20;
    public $type = null;
    public $typeId = null;

    public function mount($type = null, $typeId = null)
    {
        $this->type = $type;
        $this->typeId = $typeId;
    }

    public function render()
    {
        $query = ActivityLog::with(['user']);

        if ($this->type && $this->typeId) {
            $query->where('type', $this->type)->where('type_id', $this->typeId);
        }

        $activities = $query->latest()->limit($this->limit)->get();

        return view('livewire.discussions.activity-feed', [
            'activities' => $activities
        ]);
    }
}