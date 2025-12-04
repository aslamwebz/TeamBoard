<?php

test('authenticated user can access task index', function () {
    $this->actingAs($this->user);
    $this->get('/tasks')->assertStatus(200);
});