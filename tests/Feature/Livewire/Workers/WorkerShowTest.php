<?php

test('authenticated user can access worker show', function () {
    $this->actingAs($this->user);
    $this->get('/workers/1')->assertStatus(404);
});