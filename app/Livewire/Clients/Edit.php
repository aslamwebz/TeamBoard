<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Edit Client')]
class Edit extends Component
{
    public Client $client;
    public $clientId;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $address = '';
    public $city = '';
    public $state = '';
    public $zip_code = '';
    public $country = '';
    public $company_name = '';
    public $vat_number = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:clients,email',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:500',
        'city' => 'nullable|string|max:100',
        'state' => 'nullable|string|max:100',
        'zip_code' => 'nullable|string|max:20',
        'country' => 'nullable|string|max:100',
        'company_name' => 'nullable|string|max:255',
        'vat_number' => 'nullable|string|max:50',
    ];

    public function mount(Client $client)
    {
        $this->client = $client;
        $this->clientId = $client->id;
        $this->name = $client->name;
        $this->email = $client->email;
        $this->phone = $client->phone;
        $this->address = $client->address;
        $this->city = $client->city;
        $this->state = $client->state;
        $this->zip_code = $client->zip_code;
        $this->country = $client->country;
        $this->company_name = $client->company_name;
        $this->vat_number = $client->vat_number;
    }

    public function updateClient()
    {
        $this->rules['email'] = 'required|email|unique:clients,email,' . $this->clientId;
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
