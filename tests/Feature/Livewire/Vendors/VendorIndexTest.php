<?php

test('authenticated user can access vendor index', function () {
    $this->actingAs($this->user);
    $this->get('/vendors')->assertStatus(200);
});