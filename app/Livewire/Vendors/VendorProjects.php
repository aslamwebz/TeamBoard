<?php

namespace App\Livewire\Vendors;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class VendorProjects extends Component
{
    use WithPagination;

    public $vendorId;
    public string $search = '';
    public int $perPage = 10;

    protected $queryString = ['search'];

    public function mount($vendorId): void
    {
        $this->vendorId = $vendorId;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $query = Project::where('vendor_id', $this->vendorId);

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhereHas('client', function ($q) {
                      $q->where('name', 'like', '%' . $this->search . '%');
                  });
        }

        $projects = $query->orderBy('name')->paginate($this->perPage);

        return view('livewire.vendors.vendor-projects', [
            'projects' => $projects,
        ]);
    }
}