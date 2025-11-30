<?php

declare(strict_types=1);

use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

it('can see email verification page', function () {

    $response = $this->actingAs($this->unverifiedUser)->get('/verify-email');

    $response->assertStatus(200);
});

test('email can be verified', function () {
    Event::fake();

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $this->unverifiedUser->id, 'hash' => sha1($this->unverifiedUser->email)]
    );

    $response = $this->actingAs($this->unverifiedUser)->get($verificationUrl);

    Event::assertDispatched(Verified::class);

    expect($this->unverifiedUser->fresh()->hasVerifiedEmail())->toBeTrue();
    $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
});

test('email is not verified with invalid hash', function () {

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $this->unverifiedUser->id, 'hash' => sha1('wrong-email')]
    );

    $this->actingAs($this->unverifiedUser)->get($verificationUrl);

    expect($this->unverifiedUser->fresh()->hasVerifiedEmail())->toBeFalse();
});

test('email verification redirects if already verified', function () {
    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $this->unverifiedUser->id, 'hash' => sha1($this->unverifiedUser->email)]
    );

    $response = $this->actingAs($this->unverifiedUser)->get($verificationUrl);

    $response->assertRedirect(route('dashboard', absolute: false).'?verified=1');
    $this->assertTrue($this->unverifiedUser->fresh()->hasVerifiedEmail());
});

test('email verification link expires', function () {
    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->subMinutes(1), // Expired 1 minute ago
        ['id' => $this->unverifiedUser->id, 'hash' => sha1($this->unverifiedUser->email)]
    );

    $response = $this->actingAs($this->unverifiedUser)->get($verificationUrl);

    $response->assertStatus(403);
    $this->assertFalse($this->unverifiedUser->fresh()->hasVerifiedEmail());
});

test('email verification with invalid user id fails', function () {
    $invalidUserId = $this->unverifiedUser->id + 1000; // Non-existent user ID

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $invalidUserId, 'hash' => sha1($this->unverifiedUser->email)]
    );

    $response = $this->actingAs($this->unverifiedUser)->get($verificationUrl);

    $response->assertStatus(403);
    $this->assertFalse($this->unverifiedUser->fresh()->hasVerifiedEmail());
});

test('unauthenticated users cannot verify email', function () {

    $verificationUrl = URL::temporarySignedRoute(
        'verification.verify',
        now()->addMinutes(60),
        ['id' => $this->unverifiedUser->id, 'hash' => sha1($this->unverifiedUser->email)]
    );

    $response = $this->get($verificationUrl);

    $response->assertRedirect(route('login'));
    $this->assertFalse($this->unverifiedUser->fresh()->hasVerifiedEmail());
});
