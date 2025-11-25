<?php

namespace App\Livewire\Vendors;

use App\Models\Vendor;
use Livewire\Component;

class VendorCreate extends Component
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

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'city' => 'nullable|string|max:100',
        'state' => 'nullable|string|max:100',
        'zip_code' => 'nullable|string|max:20',
        'country' => 'nullable|string|max:100',
        'tax_id' => 'nullable|string|max:50',
        'description' => 'nullable|string',
        'rating' => 'nullable|numeric|min:0|max:5',
        'website' => 'nullable|url|max:255',
        'status' => 'required|in:active,inactive,pending',
        'payment_terms' => 'nullable|string|max:50',
        'credit_limit' => 'nullable|numeric|min:0',
    ];

    public function save()
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

    public function render()
    {
        return view('livewire.vendors.create');
    }
}