<?php

declare(strict_types=1);

namespace App\Livewire\Vendors;

use App\Models\Vendor;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

final class VendorCreate extends Component
{
    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $address = '';

    public string $city = '';

    public string $state = '';

    public string $zip_code = '';

    public string $country = '';

    public string $tax_id = '';

    public string $description = '';

    public float $rating = 0.00;

    public string $website = '';

    public string $status = 'active';

    public string $payment_terms = '';

    public float $credit_limit = 0.00;

    public function save(): RedirectResponse
    {
        $this->validate();

        $vendor = Vendor::create([
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

        return redirect()->route('vendors.show', $vendor->id)->with('message', 'Vendor created successfully.');
    }

    public function render(): View
    {
        return view('livewire.vendors.vendor-create');
    }
}
