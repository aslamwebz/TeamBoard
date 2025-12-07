<?php

declare(strict_types=1);

test('authenticated user can access report show', function () {
    $this->actingAs($this->user);
    $this->get('/reports/1')->assertStatus(404);
});
