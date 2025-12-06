<?php declare(strict_types=1);

namespace App\Livewire\Clients;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Edit Client')]
final class ClientEdit extends Component
{
    public Client $client;
    public $clientId;

    #[Validate('required|string|max:255')]
    public string $company_name = '';

    #[Validate('nullable|string|max:255')]
    public string $name = '';

    #[Validate('required|email')]
    public string $email = '';

    #[Validate('nullable|string|max:20')]
    public string $phone = '';

    #[Validate('nullable|string|max:500')]
    public string $address = '';

    #[Validate('nullable|string|max:100')]
    public string $city = '';

    #[Validate('nullable|string|max:100')]
    public string $state = '';

    #[Validate('nullable|string|max:20')]
    public string $zip_code = '';

    #[Validate('nullable|string|max:100')]
    public string $country = '';

    #[Validate('nullable|string|max:50')]
    public string $vat_number = '';

    #[Validate('nullable|string|max:255')]
    public string $logo = '';

    #[Validate('nullable|string|max:100')]
    public string $registration_number = '';

    #[Validate('nullable|string|max:50')]
    public string $tax_id = '';

    #[Validate('nullable|url|max:255')]
    public string $website = '';

    #[Validate('nullable|string|max:100')]
    public string $industry = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('nullable|string|max:50')]
    public string $billing_plan = '';

    #[Validate('nullable|date')]
    public string $subscription_start_date = '';

    #[Validate('nullable|date')]
    public string $subscription_end_date = '';

    #[Validate('nullable|string|max:50')]
    public string $subscription_status = '';

    public function mount(Client $client): void
    {
        $this->client = $client;
        $this->clientId = $client->id;

        // Load existing data into properties
        $this->company_name = $client->company_name;
        $this->name = $client->name ?? '';
        $this->email = $client->email;
        $this->phone = $client->phone ?? '';
        $this->address = $client->address ?? '';
        $this->city = $client->city ?? '';
        $this->state = $client->state ?? '';
        $this->zip_code = $client->zip_code ?? '';
        $this->country = $client->country ?? '';
        $this->vat_number = $client->vat_number ?? '';
        $this->logo = $client->logo ?? '';
        $this->registration_number = $client->registration_number ?? '';
        $this->tax_id = $client->tax_id ?? '';
        $this->website = $client->website ?? '';
        $this->industry = $client->industry ?? '';
        $this->description = $client->description ?? '';
        $this->billing_plan = $client->billing_plan ?? '';
        $this->subscription_start_date = $client->subscription_start_date ? $client->subscription_start_date->format('Y-m-d') : '';
        $this->subscription_end_date = $client->subscription_end_date ? $client->subscription_end_date->format('Y-m-d') : '';
        $this->subscription_status = $client->subscription_status ?? '';
    }

    public function updateClient(): RedirectResponse
    {
        $this->validate([
            'company_name' => 'required|string|max:255|unique:clients,company_name,' . $this->clientId,
            'email' => 'required|email|unique:clients,email,' . $this->clientId,
        ]);

        $this->client->update([
            'company_name' => $this->company_name,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
            'country' => $this->country,
            'vat_number' => $this->vat_number,
            'logo' => $this->logo,
            'registration_number' => $this->registration_number,
            'tax_id' => $this->tax_id,
            'website' => $this->website,
            'industry' => $this->industry,
            'description' => $this->description,
            'billing_plan' => $this->billing_plan,
            'subscription_start_date' => $this->subscription_start_date ?: null,
            'subscription_end_date' => $this->subscription_end_date ?: null,
            'subscription_status' => $this->subscription_status,
        ]);

        return redirect()->route('clients.index');
    }

    public function render(): View
    {
        return view('livewire.clients.client-edit');
    }
}
