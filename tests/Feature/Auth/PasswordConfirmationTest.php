<?php

declare(strict_types=1);

use App\Livewire\Auth\ConfirmPassword;
use Livewire\Livewire;

test('confirm password screen can be rendered', function () {

    $response = $this->actingAs($this->user)->get('/confirm-password');

    $response->assertStatus(200);
});

test('password can be confirmed', function () {

    $this->actingAs($this->user);

    $response = Livewire::test(ConfirmPassword::class)
        ->set('password', 'password')
        ->call('confirmPassword');

    $response
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));
});

test('password is not confirmed with invalid password', function () {

    $this->actingAs($this->user);

    $response = Livewire::test(ConfirmPassword::class)
        ->set('password', 'wrong-password')
        ->call('confirmPassword');

    $response->assertHasErrors(['password']);
});
