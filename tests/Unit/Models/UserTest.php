<?php

declare(strict_types=1);

use App\Models\User;
use Spatie\Permission\Models\Permission;

test('to array', function () {

    $user = User::factory()->create()->refresh();

    expect(array_keys($user->toArray()))->toBe([
        'id',
        'name',
        'email',
        'email_verified_at',
        'created_at',
        'updated_at',
    ]);
});
