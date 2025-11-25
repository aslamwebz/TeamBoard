<?php

namespace App\Livewire\Workers;

use App\Models\WorkerProfile;
use Livewire\Component;
use Livewire\WithPagination;

class WorkerIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';
    public string $department = '';
    public int $perPage = 10;

    protected $queryString = ['search', 'status', 'department'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = WorkerProfile::with(['user']);

        if ($this->search) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
            })->orWhere('job_title', 'like', '%' . $this->search . '%')
              ->orWhere('department', 'like', '%' . $this->search . '%');
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        if ($this->department) {
            $query->where('department', $this->department);
        }

        $workers = $query->orderBy('created_at', 'desc')->paginate($this->perPage);

        // Get unique departments for filter dropdown
        $departments = WorkerProfile::select('department')->whereNotNull('department')->distinct()->pluck('department');

        return view('livewire.workers.index', [
            'workers' => $workers,
            'departments' => $departments,
        ]);
    }
}