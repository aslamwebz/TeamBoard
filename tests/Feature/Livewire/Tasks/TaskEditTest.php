<?php

test('authenticated user can access task edit', function () {
    $this->actingAs($this->user);
    $this->get('/tasks/1/edit')->assertStatus(404);
});