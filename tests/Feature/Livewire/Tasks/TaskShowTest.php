<?php

test('authenticated user can access task show', function () {
    $this->actingAs($this->user);
    $this->get('/tasks/1')->assertStatus(404);
});