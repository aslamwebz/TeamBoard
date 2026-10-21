<?php

declare(strict_types=1);

use App\Livewire\Settings\CompanyProfile;
use Livewire\Livewire;

test('can instantiate company profile settings component', function () {
    $this->actingAsAdmin();
    Livewire::test(CompanyProfile::class)
        ->assertStatus(200);
});
