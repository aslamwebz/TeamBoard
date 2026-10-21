<?php

declare(strict_types=1);

test('authenticated user can access permission edit when exists', function () {
    $this->actingAsAdmin();
    $this->get('/permissions/1/edit')->assertStatus(200);
});
