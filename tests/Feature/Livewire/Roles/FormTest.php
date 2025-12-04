<?php

test('authenticated user can access role form', function () {
    $this->actingAs($this->user);
    $this->get('/roles/create')->assertStatus(200);
});