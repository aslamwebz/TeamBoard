<?php

test('authenticated user can access client edit', function () {
    $this->actingAs($this->user);
    $this->get('/clients/1/edit')->assertStatus(404);
});