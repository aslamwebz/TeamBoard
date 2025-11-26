<?php

namespace App\Livewire\Workers;

use App\Models\WorkerProfile;
use Livewire\Component;

class WorkerShow extends Component
{
    public WorkerProfile $workerProfile;

    public function mount(WorkerProfile $workerProfile): void
    {
        $this->workerProfile = $workerProfile->load(['user', 'skills', 'certifications', 'timesheets']);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.workers.worker-show');
    }
}