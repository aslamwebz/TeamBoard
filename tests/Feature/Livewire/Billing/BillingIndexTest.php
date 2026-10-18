<?php

declare(strict_types=1);

use App\Livewire\Billing\BillingIndex;
use Livewire\Livewire;

test('admin user can view billing page', function () {
    $this->actingAs($this->admin);

    // Verify route access
    $this->get(route('billing'))
        ->assertStatus(200)
        ->assertSeeLivewire(BillingIndex::class);
});

test('non-admin cannot view billing page', function () {
    $this->actingAs($this->employee);

    $this->get(route('billing'))
        ->assertStatus(403);
});

test('billing page shows available plans', function () {
    $this->actingAs($this->admin);

    // Verify component content
    Livewire::test(BillingIndex::class)
        ->assertSee('Basic')
        ->assertSee('Starter')
        ->assertSee('Pro')
        ->assertSee('Enterprise')
        ->assertSee('Subscribe');
});
