<?php declare(strict_types=1);

namespace App\Livewire\Clients;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Edit Client')]
final class ClientEdit extends Component
{
    public Client $client;
    public $clientId;

    protected $rules = [
        'client.company_name' => 'required|string|max:255',
        'client.name' => 'nullable|string|max:255',
        'client.email' => 'required|email|unique:clients,email',
        'client.phone' => 'nullable|string|max:20',
        'client.address' => 'nullable|string|max:500',
        'client.city' => 'nullable|string|max:100',
        'client.state' => 'nullable|string|max:100',
        'client.zip_code' => 'nullable|string|max:20',
        'client.country' => 'nullable|string|max:100',
        'client.vat_number' => 'nullable|string|max:50',
        'client.logo' => 'nullable|string|max:255',
        'client.registration_number' => 'nullable|string|max:100',
        'client.tax_id' => 'nullable|string|max:50',
        'client.website' => 'nullable|url|max:255',
        'client.industry' => 'nullable|string|max:100',
        'client.description' => 'nullable|string',
        'client.billing_plan' => 'nullable|string|max:50',
        'client.subscription_start_date' => 'nullable|date',
        'client.subscription_end_date' => 'nullable|date',
        'client.subscription_status' => 'nullable|string|max:50',
    ];

    public function mount(Client $client): void
    {
        $this->client = $client;
        $this->clientId = $client->id;
    }

    public function updateClient(): RedirectResponse
    {
        $this->rules['client.email'] = 'required|email|unique:clients,email,' . $this->clientId;
        $this->rules['client.company_name'] = 'required|string|max:255|unique:clients,company_name,' . $this->clientId;
        $validated = $this->validate();

        $client = Client::find($this->clientId);
        if ($client) {
            $client->update($validated['client']);
        }

        return redirect()->route('clients.index');
    }

    public function render(): View
    {
        return view('livewire.clients.client-edit');
    }
}
