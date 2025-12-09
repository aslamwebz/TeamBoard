<?php

declare(strict_types=1);

namespace App\Livewire\Vendors;

use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Livewire\Component;

final class VendorEdit extends Component
{
    public Vendor $vendor;

    public string $name = '';

    public ?string $email = '';

    public ?string $phone = '';

    public ?string $address = '';

    public ?string $city = '';

    public ?string $state = '';

    public ?string $zip_code = '';

    public ?string $country = '';

    public ?string $tax_id = '';

    public ?string $description = '';

    public float $rating = 0.0;

    public ?string $website = '';

    public string $status = 'active';

    public ?string $payment_terms = '';

    public float $credit_limit = 0.0;

    public function mount(Vendor $vendor): void
    {
        $this->vendor = $vendor;
        $this->fill([
            'name' => $vendor->name,
            'email' => $vendor->email,
            'phone' => $vendor->phone,
            'address' => $vendor->address,
            'city' => $vendor->city,
            'state' => $vendor->state,
            'zip_code' => $vendor->zip_code,
            'country' => $vendor->country,
            'tax_id' => $vendor->tax_id,
            'description' => $vendor->description,
            'rating' => $vendor->rating,
            'website' => $vendor->website,
            'status' => $vendor->status,
            'payment_terms' => $vendor->payment_terms,
            'credit_limit' => $vendor->credit_limit,
        ]);
    }

    public function update(): void
    {
        $this->validate();

        $this->vendor->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
            'country' => $this->country,
            'tax_id' => $this->tax_id,
            'description' => $this->description,
            'rating' => $this->rating,
            'website' => $this->website,
            'status' => $this->status,
            'payment_terms' => $this->payment_terms,
            'credit_limit' => $this->credit_limit,
        ]);

        $this->redirectRoute('vendors.show', $this->vendor->id, navigate: true);
    }

    public function render(): View
    {
        return view('livewire.vendors.vendor-edit');
    }
}
