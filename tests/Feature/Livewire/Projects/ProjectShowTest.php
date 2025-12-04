<?php

test('authenticated user can access project show', function () {
    $this->actingAs($this->user);
    $this->get('/projects/1')->assertStatus(404);
});