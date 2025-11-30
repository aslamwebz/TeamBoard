<?php declare(strict_types=1);

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

test('reset password link screen can be rendered', function () {
    $response = $this->get('/forgot-password');

    $response->assertStatus(200);
});

test('reset password link can be requested', function () {
    Notification::fake();

    $this->actingAs($this->user);

    Livewire::test(ForgotPassword::class)
        ->set('email', $this->user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($this->user, ResetPasswordNotification::class);
});

test('reset password screen can be rendered', function () {
    Notification::fake();

    $this->actingAs($this->user);

    Livewire::test(ForgotPassword::class)
        ->set('email', $this->user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($this->user, ResetPasswordNotification::class, function ($notification) {
        $this->actingAs($this->user);

        $response = $this->get('/reset-password/' . $notification->token);

        $response->assertStatus(200);

        return true;
    });
});

test('password can be reset with valid token', function () {
    Notification::fake();

    Livewire::test(ForgotPassword::class)
        ->set('email', $this->user->email)
        ->call('sendPasswordResetLink');

    Notification::assertSentTo($this->user, ResetPasswordNotification::class, function ($notification) {
        $response = Livewire::test(ResetPassword::class, ['token' => $notification->token])
            ->set('email', $this->user->email)
            ->set('password', 'password')
            ->set('password_confirmation', 'password')
            ->call('resetPassword');

        $response
            ->assertHasNoErrors()
            ->assertRedirect(route('login', absolute: false));

        return true;
    });
});
