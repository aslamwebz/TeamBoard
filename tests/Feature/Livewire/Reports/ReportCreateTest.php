<?php

declare(strict_types=1);

test('authenticated user can access report create', function () {
    $this->actingAs($this->user);
    $this->get('/reports/create')->assertStatus(200);
});
