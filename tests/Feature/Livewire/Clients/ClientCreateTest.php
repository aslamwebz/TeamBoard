<?php

test('authenticated user can access client create', function () {
    $this->actingAs($this->user);
    $this->get('/clients/create')->assertStatus(200);
});