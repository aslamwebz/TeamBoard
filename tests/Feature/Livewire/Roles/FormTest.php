<?php

declare(strict_types=1);

test('authenticated user can access role form', function () {
    $this->actingAsAdmin();
    $this->get('/roles/create')->assertStatus(200);
});
