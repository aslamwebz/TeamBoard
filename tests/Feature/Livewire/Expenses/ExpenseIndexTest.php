<?php

test('authenticated user can access expense index', function () {
    $this->actingAs($this->user);
    $this->get('/expenses')->assertStatus(200);
});