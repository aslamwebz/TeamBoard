<?php

test('authenticated user can access invoice index', function () {
    $this->actingAs($this->user);
    $this->get('/invoices')->assertStatus(200);
});