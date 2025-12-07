<?php

declare(strict_types=1);

test('authenticated user can access home', function () {
    $this->actingAs($this->user);
    $this->get('/')->assertStatus(200);
});
