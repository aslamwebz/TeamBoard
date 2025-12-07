<?php

declare(strict_types=1);

test('authenticated user can access pricing index', function () {
    $this->actingAs($this->user);
    $this->get('/pricing')->assertStatus(200);
});
