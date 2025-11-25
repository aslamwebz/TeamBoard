<?php

namespace App\Livewire\Vendors;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class VendorTasks extends Component
{
    use WithPagination;

    public $vendorId;
    public string $search = '';
    public int $perPage = 10;

    protected $queryString = ['search'];

    public function mount($vendorId)
    {
        $this->vendorId = $vendorId;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Task::where('vendor_id', $this->vendorId)->with(['project']);

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhereHas('project', function ($q) {
                      $q->where('name', 'like', '%' . $this->search . '%');
                  });
        }

        $tasks = $query->orderBy('title')->paginate($this->perPage);

        return view('livewire.vendors.vendor-tasks', [
            'tasks' => $tasks,
        ]);
    }
}