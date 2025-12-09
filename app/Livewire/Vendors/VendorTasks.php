<?php

declare(strict_types=1);

namespace App\Livewire\Vendors;

use App\Models\Task;
use App\Models\Vendor;
use Livewire\Component;
use Livewire\WithPagination;

final class VendorTasks extends Component
{
    use WithPagination;

    public $vendorId;

    public string $search = '';

    public int $perPage = 10;

    private array $queryString = ['search'];

    public function mount($vendor): void
    {
        $this->vendorId = $vendor;
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        $vendor = Vendor::findOrFail($this->vendorId);

        $query = Task::where('vendor_id', $this->vendorId)->with(['project']);

        if ($this->search !== '' && $this->search !== '0') {
            $query
                ->where('title', 'like', '%'.$this->search.'%')
                ->orWhereHas('project', function ($q): void {
                    $q->where('name', 'like', '%'.$this->search.'%');
                });
        }

        $tasks = $query->orderBy('title')->paginate($this->perPage);

        return view('livewire.vendors.vendor-tasks', [
            'vendor' => $vendor,
            'tasks' => $tasks,
        ]);
    }
}
