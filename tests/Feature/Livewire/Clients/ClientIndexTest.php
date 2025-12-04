<?php

test('authenticated user can access client index', function () {
    $this->actingAs($this->user);
    $this->get('/clients')->assertStatus(200);
});