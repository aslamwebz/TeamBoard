<?php

declare(strict_types=1);

namespace App\Livewire\Settings;

use App\Models\Tenant;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

#[Layout('components.layouts.app')]
#[Title('Company Profile')]
final class CompanyProfile extends Component
{
    use WithFileUploads;

    public $legal_name;

    public $logo;

    public $address;

    public $phone;

    public $email;

    public $tax_vat_number;

    public $industry;

    public $currency;

    public $timezone;

    public $branding = [];

    public $currentLogoUrl;

    public $logoPreview;

    public function mount(): void
    {
        abort_unless(auth()->user()?->hasRole(['admin', 'manager']), 403);

        $tenant = Tenant::current();
        if ($tenant instanceof Tenant) {
            $this->legal_name = $tenant->legal_name;
            $this->address = $tenant->address;
            $this->phone = $tenant->phone;
            $this->email = $tenant->email;
            $this->tax_vat_number = $tenant->tax_vat_number;
            $this->industry = $tenant->industry;
            $this->currency = $tenant->currency ?? 'USD';
            $this->timezone = $tenant->timezone ?? 'UTC';

            if ($tenant->logo) {
                $this->currentLogoUrl = $tenant->logo_url;
            }

            $this->branding = $tenant->branding ?? [];
        }
    }

    public function updatedLogo(): void
    {
        $this->validateOnly('logo');
        $this->logoPreview = $this->logo->temporaryUrl();
    }

    public function save(): void
    {
        abort_unless(auth()->user()?->hasRole(['admin', 'manager']), 403);

        $validatedData = $this->validate();

        $tenant = Tenant::current();
        if (! $tenant instanceof Tenant) {
            $this->addError('general', 'No active tenant found.');

            return;
        }

        // Handle logo upload
        if ($this->logo) {
            // Delete old logo if exists
            if ($tenant->logo) {
                Storage::delete($tenant->logo);
            }

            // Store new logo
            $path = $this->logo->store('logos', 'public');
            $validatedData['logo'] = $path;
        } else {
            unset($validatedData['logo']);
        }

        $tenant->update($validatedData);

        // Update session or cache if needed for company settings
        session()->flash('message', 'Company profile updated successfully.');
    }

    public function removeLogo(): void
    {
        abort_unless(auth()->user()?->hasRole(['admin', 'manager']), 403);

        $tenant = Tenant::current();
        if ($tenant && $tenant->logo) {
            Storage::delete($tenant->logo);
            $tenant->update(['logo' => null]);
            $this->currentLogoUrl = null;
            $this->logo = null;
            session()->flash('message', 'Logo removed successfully.');
        }
    }

    public function isFieldInvalid($field): bool
    {
        return $this->getErrorBag()->has($field);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.settings.company-profile');
    }

    protected function rules(): array
    {
        return [
            'legal_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'tax_vat_number' => 'nullable|string|max:50',
            'industry' => 'nullable|string|max:100',
            'currency' => 'required|string|size:3',
            'timezone' => 'required|string|max:50',
            'logo' => 'nullable|image|max:2048', // 2MB Max
        ];
    }
}
