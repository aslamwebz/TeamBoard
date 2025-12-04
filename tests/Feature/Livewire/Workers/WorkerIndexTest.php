<?php

test('authenticated user can access worker index', function () {
    $this->actingAs($this->user);
    $this->get('/workers')->assertStatus(200);
});