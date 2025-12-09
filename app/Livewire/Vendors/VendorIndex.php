<?php

declare(strict_types=1);

namespace App\Livewire\Vendors;

use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

final class VendorIndex extends Component
{
    use WithPagination;

    public string $search = '';

    public string $status = '';

    public int $perPage = 10;

    private array $queryString = ['search', 'status'];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $query = Vendor::query();

        if ($this->search !== '' && $this->search !== '0') {
            $query->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('email', 'like', '%'.$this->search.'%')
                ->orWhere('phone', 'like', '%'.$this->search.'%');
        }

        if ($this->status !== '' && $this->status !== '0') {
            $query->where('status', $this->status);
        }

        $vendors = $query->orderBy('name')->paginate($this->perPage);

        return view('livewire.vendors.vendor-index', [
            'vendors' => $vendors,
        ]);
    }

    public function getStatusBadgeClass(string $status): string
    {
        $vendorStatus = \App\Enums\VendorStatus::tryFrom($status);
        if ($vendorStatus) {
            return $vendorStatus->getColorClass();
        }

        return 'bg-gray-100 text-gray-800';
    }
}
