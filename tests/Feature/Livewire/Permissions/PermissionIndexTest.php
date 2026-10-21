<?php

declare(strict_types=1);

test('authenticated user can access permission index', function () {
    $this->actingAsAdmin();
    $this->get('/permissions')->assertStatus(200);
});
