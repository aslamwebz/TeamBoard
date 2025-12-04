<?php

test('authenticated user can access task create', function () {
    $this->actingAs($this->user);
    $this->get('/tasks/create')->assertStatus(200);
});