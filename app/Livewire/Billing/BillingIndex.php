<?php

declare(strict_types=1);

namespace App\Livewire\Billing;

use Illuminate\Contracts\View\View;
use Livewire\Component;

final class BillingIndex extends Component
{
    public bool $showPlans = false;

    public function mount()
    {
        // Simple check for admin execution context or role
        // Assuming 'admin' role or permissions setup.
        // If strict 'admin' role is needed:
        if (! auth()->user()->hasRole('admin')) {
            abort(403, 'Only administrators can manage billing.');
        }

        // Check if user has no valid subscription (active or grace), show plans by default
        if (! \App\Models\Tenant::current()->subscribed('default')) {
            $this->showPlans = true;
        }
    }

    public function showPlans()
    {
        $this->showPlans = true;
    }

    public function cancelPlans()
    {
        $this->showPlans = false;
    }

    public function getPlansProperty(): array
    {
        return [
            [
                'id' => 'price_1ScLikDGxuDnCtkqZtudfCDq',
                'name' => 'Basic',
                'price' => '$29',
                'description' => 'Essential tools for small teams',
                'features' => ['Up to 5 Projects', '5 Team Members', 'Basic Reporting'],
            ],
            [
                'id' => 'price_1ScLikDGxuDnCtkqS1ss5e2D',
                'name' => 'Starter',
                'price' => '$49',
                'description' => 'Great for growing businesses',
                'features' => ['Up to 15 Projects', '15 Team Members', 'Standard Reporting', 'Email Support'],
            ],
            [
                'id' => 'price_1ScLilDGxuDnCtkqr3wi8YRH',
                'name' => 'Pro',
                'price' => '$99',
                'description' => 'Advanced features for scaling',
                'features' => ['Unlimited Projects', 'Unlimited Team Members', 'Advanced Reporting', 'Priority Support', 'API Access'],
            ],
            [
                'id' => 'price_1ScLilDGxuDnCtkqSKz5mswz',
                'name' => 'Enterprise',
                'price' => '$199',
                'description' => 'Maximum power and control',
                'features' => ['Everything in Pro', 'Dedicated Account Manager', 'SSO Integration', 'Audit Logs', 'Custom Contracts'],
            ],
        ];
    }

    public function checkout(string $priceId)
    {
        $tenant = \App\Models\Tenant::current();

        $checkout = $tenant->newSubscription('default', $priceId)
            ->checkout([
                'success_url' => route('billing'),
                'cancel_url' => route('billing'),
            ]);

        return redirect($checkout->url);
    }

    public function swap(string $priceId)
    {
        $tenant = \App\Models\Tenant::current();

        $tenant->subscription('default')->swap($priceId);

        $this->dispatch('notify', message: 'Plan updated successfully!');
    }

    public function resume()
    {
        $tenant = \App\Models\Tenant::current();

        $tenant->subscription('default')->resume();

        $this->dispatch('notify', message: 'Subscription resumed!');
    }

    public function portal()
    {
        return \App\Models\Tenant::current()->billingPortalUrl(route('billing'));
    }

    public function render(): View
    {
        $tenant = \App\Models\Tenant::current();

        return view('livewire.billing.billing-index', [
            'tenant' => $tenant,
            'currentSubscription' => $tenant->subscription('default'),
            'invoices' => $tenant->invoices(),
        ]);
    }
}
