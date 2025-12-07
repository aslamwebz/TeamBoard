<?php

declare(strict_types=1);

test('authenticated user can access password settings', function () {
    $this->actingAs($this->user);
    $this->get('/settings/password')->assertStatus(200);
});
