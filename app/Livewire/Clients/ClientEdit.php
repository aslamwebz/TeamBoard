<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Edit Client')]
class ClientEdit extends Component
{
    public Client $client;
    public $clientId;
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
        'company_name' => 'required|string|max:255',
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

    public function mount(Client $client)
    {
        $this->client = $client;
        $this->clientId = $client->id;
        $this->company_name = $client->company_name;
        $this->name = $client->name;
        $this->email = $client->email;
        $this->phone = $client->phone;
        $this->address = $client->address;
        $this->city = $client->city;
        $this->state = $client->state;
        $this->zip_code = $client->zip_code;
        $this->country = $client->country;
        $this->vat_number = $client->vat_number;
        $this->logo = $client->logo;
        $this->registration_number = $client->registration_number;
        $this->tax_id = $client->tax_id;
        $this->website = $client->website;
        $this->industry = $client->industry;
        $this->description = $client->description;
        $this->billing_plan = $client->billing_plan;
        $this->subscription_start_date = $client->subscription_start_date ? $client->subscription_start_date->format('Y-m-d') : '';
        $this->subscription_end_date = $client->subscription_end_date ? $client->subscription_end_date->format('Y-m-d') : '';
        $this->subscription_status = $client->subscription_status;
    }

    public function updateClient()
    {
        $this->rules['email'] = 'required|email|unique:clients,email,' . $this->clientId;
        $this->rules['company_name'] = 'required|string|max:255|unique:clients,company_name,' . $this->clientId;
        $validated = $this->validate();

        $client = Client::find($this->clientId);
        if ($client) {
            $client->update($validated);
        }

        return $this->redirectRoute('clients.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.clients.edit');
    }
}
