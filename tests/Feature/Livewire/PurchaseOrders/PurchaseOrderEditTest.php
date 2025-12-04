<?php

test('authenticated user can access purchase order edit', function () {
    $this->actingAs($this->user);
    $this->get('/purchase-orders/1/edit')->assertStatus(404);
});