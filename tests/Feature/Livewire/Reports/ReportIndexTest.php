<?php

declare(strict_types=1);

test('authenticated user can access report index', function () {
    $this->actingAs($this->user);
    $this->get('/reports')->assertStatus(200);
});
