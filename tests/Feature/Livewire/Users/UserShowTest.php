<?php

declare(strict_types=1);

test('authenticated user can access user show when exists', function () {
    $this->actingAs($this->user);
    $this->get('/users/1')->assertStatus(200);
});
