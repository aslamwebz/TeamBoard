<?php

test('authenticated user can access team edit', function () {
    $this->actingAs($this->user);
    $this->get('/teams/1/edit')->assertStatus(404);
});