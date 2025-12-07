<?php

declare(strict_types=1);

test('authenticated user can access purchase order show', function () {
    $this->actingAs($this->user);
    $this->get('/purchase-orders/1')->assertStatus(404);
});
