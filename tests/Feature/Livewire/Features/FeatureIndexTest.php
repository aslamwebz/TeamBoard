<?php

test('authenticated user can access features index', function () {
    $this->actingAs($this->user);
    $this->get('/features')->assertStatus(200);
});