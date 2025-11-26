<?php

namespace App\Livewire\Vendors;

use App\Models\VendorContact;
use Livewire\Component;
use Livewire\WithPagination;

class VendorContacts extends Component
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
        $query = VendorContact::where('vendor_id', $this->vendorId);

        if ($this->search) {
            $query->where('first_name', 'like', '%' . $this->search . '%')
                  ->orWhere('last_name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
        }

        $contacts = $query->orderBy('is_primary', 'desc')->orderBy('first_name')->paginate($this->perPage);

        return view('livewire.vendors.vendor-contacts', [
            'contacts' => $contacts,
        ]);
    }
}