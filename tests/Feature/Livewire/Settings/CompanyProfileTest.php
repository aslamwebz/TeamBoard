<?php

use Livewire\Livewire;

test('can instantiate company profile settings component', function () {
    $this->actingAs($this->user);
    Livewire::test(\App\Livewire\Settings\CompanyProfile::class)
        ->assertStatus(200);
});