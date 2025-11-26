<?php

namespace App\Livewire\Vendors;

use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class VendorIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';
    public int $perPage = 10;

    protected $queryString = ['search', 'status'];

    public function updatingSearch() : void
    {
        $this->resetPage();
    }

    public function render() : View
    {
        $query = Vendor::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('phone', 'like', '%' . $this->search . '%');
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        $vendors = $query->orderBy('name')->paginate($this->perPage);

        return view('livewire.vendors.vendor-index', [
            'vendors' => $vendors,
        ]);
    }

    public function getStatusBadgeClass(string $status): string
    {
        return match($status) {
            'active' => 'bg-green-100 text-green-800',
            'inactive' => 'bg-red-100 text-red-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}