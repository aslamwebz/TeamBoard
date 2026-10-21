<?php

declare(strict_types=1);

test('authenticated user can access payment create', function () {
    $this->actingAsAdmin();
    $this->get('/payments/create')->assertStatus(200);
});
