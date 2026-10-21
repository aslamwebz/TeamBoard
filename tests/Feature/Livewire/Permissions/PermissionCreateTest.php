<?php

declare(strict_types=1);

test('authenticated user can access permission create', function () {
    $this->actingAsAdmin();
    $this->get('/permissions/create')->assertStatus(200);
});
