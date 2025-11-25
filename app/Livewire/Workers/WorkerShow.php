<?php

namespace App\Livewire\Workers;

use App\Models\WorkerProfile;
use Livewire\Component;

class WorkerShow extends Component
{
    public WorkerProfile $workerProfile;

    public function mount(WorkerProfile $workerProfile)
    {
        $this->workerProfile = $workerProfile->load(['user', 'skills', 'certifications', 'timesheets']);
    }

    public function render()
    {
        return view('livewire.workers.show');
    }
}