<?php

test('authenticated user can access invoice edit', function () {
    $this->actingAs($this->user);
    $this->get('/invoices/1/edit')->assertStatus(404);
});