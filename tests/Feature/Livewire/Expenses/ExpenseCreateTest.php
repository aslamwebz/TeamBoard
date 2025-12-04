<?php

test('authenticated user can access expense create', function () {
    $this->actingAs($this->user);
    $this->get('/expenses/create')->assertStatus(200);
});