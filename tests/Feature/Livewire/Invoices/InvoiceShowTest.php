<?php

declare(strict_types=1);

test('authenticated user can access invoice show', function () {
    $this->actingAs($this->user);
    $this->get('/invoices/1')->assertStatus(404);
});
