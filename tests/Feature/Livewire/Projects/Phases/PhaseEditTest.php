<?php

test('authenticated user can access phase edit', function () {
    $this->actingAs($this->user);
    $this->get('/phases/1/edit')->assertStatus(404);
});