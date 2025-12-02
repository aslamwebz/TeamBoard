<?php

declare(strict_types=1);

namespace App\Livewire\Discussions;

use App\Models\ActivityLog;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Activity Feed')]
final class ActivityFeed extends Component
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
            'activities' => $activities,
        ]);
    }
}
