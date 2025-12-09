<?php

declare(strict_types=1);

namespace App\Livewire\Discussions;

use App\Models\ActivityLog;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Activity Feed')]
final class ActivityFeed extends Component
{
    public $limit = 20;

    public $type;

    public $typeId;

    public function mount($type = null, $typeId = null): void
    {
        $this->type = $type;
        $this->typeId = $typeId;
    }

    public function render(): View
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
