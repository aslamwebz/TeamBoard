<?php

declare(strict_types=1);

namespace App\Livewire\Clients;

use App\Events\ClientAddedNotification;
use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Create Client')]
final class ClientCreate extends Component
{
    #[Validate('required|string|max:255|unique:clients,company_name')]
    public string $company_name = '';

    #[Validate('nullable|string|max:255')]
    public string $name = '';

    #[Validate('required|email|unique:clients,email')]
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

    public function createClient(): RedirectResponse
    {
        $validated = $this->validate();

        $client = Client::create($validated);

        // Dispatch notification when client is added
        ClientAddedNotification::dispatch($client, Auth::user());

        return redirect()->route('clients.index');
    }

    public function render(): View
    {
        return view('livewire.clients.client-create');
    }
}
