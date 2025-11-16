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

    public function createClient()
    {
        $validated = $this->validate();

        Client::create($validated);

        return $this->redirectRoute('clients.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.clients.create');
    }
}