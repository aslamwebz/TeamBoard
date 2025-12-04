<?php

test('authenticated user can access payment edit', function () {
    $this->actingAs($this->user);
    $this->get('/payments/1/edit')->assertStatus(404);
});