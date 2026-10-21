<?php

declare(strict_types=1);

test('authenticated user can access task create', function () {
    $this->actingAsAdmin();
    $this->get('/tasks/create')->assertStatus(200);
});
