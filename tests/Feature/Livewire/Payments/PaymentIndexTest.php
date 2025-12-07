<?php

declare(strict_types=1);

test('authenticated user can access payment index', function () {
    $this->actingAs($this->user);
    $this->get('/payments')->assertStatus(200);
});
