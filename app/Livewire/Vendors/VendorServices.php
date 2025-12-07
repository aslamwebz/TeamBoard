<?php

declare(strict_types=1);

namespace App\Livewire\Vendors;

use App\Models\Vendor;
use App\Models\VendorService;
use Livewire\Component;
use Livewire\WithPagination;

final class VendorServices extends Component
{
    use WithPagination;

    public $vendorId;

    public string $search = '';

    public int $perPage = 10;

    protected $queryString = ['search'];

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

        $query = VendorService::where('vendor_id', $this->vendorId);

        if ($this->search) {
            $query
                ->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('category', 'like', '%'.$this->search.'%');
        }

        $services = $query->orderBy('name')->paginate($this->perPage);

        return view('livewire.vendors.vendor-services', [
            'vendor' => $vendor,
            'services' => $services,
        ]);
    }
}
