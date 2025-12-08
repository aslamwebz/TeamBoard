<?php declare(strict_types=1);

use App\Livewire\Settings\DeleteUserForm;
use Livewire\Livewire;

test('can instantiate delete user form component', function () {
    $this->actingAs($this->user);
    Livewire::test(DeleteUserForm::class)
        ->assertStatus(200);
});
