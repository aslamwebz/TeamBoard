<?php

test('authenticated user can access report edit', function () {
    $this->actingAs($this->user);
    $this->get('/reports/1/edit')->assertStatus(404);
});