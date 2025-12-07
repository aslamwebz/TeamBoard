<?php

declare(strict_types=1);

test('authenticated user can access user index', function () {
    $this->actingAs($this->user);
    $this->get('/users')->assertStatus(200);
});
