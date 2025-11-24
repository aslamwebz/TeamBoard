<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Create Client')]
class Create extends Component
{
    public $company_name = '';
    public $name = '';
    public $email = '';
    public $phone = '';
    public $address = '';
    public $city = '';
    public $state = '';
    public $zip_code = '';
    public $country = '';
    public $vat_number = '';
    public $logo = '';
    public $registration_number = '';
    public $tax_id = '';
    public $website = '';
    public $industry = '';
    public $description = '';
    public $billing_plan = '';
    public $subscription_start_date = '';
    public $subscription_end_date = '';
    public $subscription_status = '';

    protected $rules = [
        'company_name' => 'required|string|max:255|unique:clients,company_name',
        'name' => 'nullable|string|max:255',
        'email' => 'required|email|unique:clients,email',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:500',
        'city' => 'nullable|string|max:100',
        'state' => 'nullable|string|max:100',
        'zip_code' => 'nullable|string|max:20',
        'country' => 'nullable|string|max:100',
        'vat_number' => 'nullable|string|max:50',
        'logo' => 'nullable|string|max:255',
        'registration_number' => 'nullable|string|max:100',
        'tax_id' => 'nullable|string|max:50',
        'website' => 'nullable|url|max:255',
        'industry' => 'nullable|string|max:100',
        'description' => 'nullable|string',
        'billing_plan' => 'nullable|string|max:50',
        'subscription_start_date' => 'nullable|date',
        'subscription_end_date' => 'nullable|date',
        'subscription_status' => 'nullable|string|max:50',
    ];

    public function createClient()
    {
        $validated = $this->validate();

        $client = Client::create($validated);

        // Dispatch notification when client is added
        \App\Events\ClientAddedNotification::dispatch($client, auth()->user());

        return $this->redirectRoute('clients.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.clients.create');
    }
}