<?php

declare(strict_types=1);

use Livewire\Livewire;

test('can instantiate delete user form component', function () {
    $this->actingAs($this->user);
    Livewire::test(App\Livewire\Settings\DeleteUserForm::class)
        ->assertStatus(200);
});
