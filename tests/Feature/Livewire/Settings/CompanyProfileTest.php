<?php declare(strict_types=1);

use App\Livewire\Settings\CompanyProfile;
use Livewire\Livewire;

test('can instantiate company profile settings component', function () {
    $this->actingAs($this->user);
    Livewire::test(CompanyProfile::class)
        ->assertStatus(200);
});
