<?php

namespace App\Livewire\Vendors;

use App\Models\VendorService;
use Livewire\Component;
use Livewire\WithPagination;

class VendorServices extends Component
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
        $query = VendorService::where('vendor_id', $this->vendorId);

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('category', 'like', '%' . $this->search . '%');
        }

        $services = $query->orderBy('name')->paginate($this->perPage);

        return view('livewire.vendors.vendor-services', [
            'services' => $services,
        ]);
    }
}