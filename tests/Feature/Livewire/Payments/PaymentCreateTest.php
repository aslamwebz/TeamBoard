<?php

declare(strict_types=1);

test('authenticated user can access payment create', function () {
    $this->actingAs($this->user);
    $this->get('/payments/create')->assertStatus(200);
});
