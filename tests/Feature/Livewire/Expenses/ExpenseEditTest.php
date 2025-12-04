<?php

test('authenticated user can access expense edit', function () {
    $this->actingAs($this->user);
    $this->get('/expenses/1/edit')->assertStatus(404);
});