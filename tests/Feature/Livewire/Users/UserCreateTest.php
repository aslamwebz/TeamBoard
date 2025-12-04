<?php

test('authenticated user can access user create', function () {
    $this->actingAs($this->user);
    $this->get('/users/create')->assertStatus(200);
});