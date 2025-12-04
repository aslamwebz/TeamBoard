<?php

test('authenticated user can access project create', function () {
    $this->actingAs($this->user);
    $this->get('/projects/create')->assertStatus(200);
});