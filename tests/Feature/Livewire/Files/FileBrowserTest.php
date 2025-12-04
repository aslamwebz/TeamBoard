<?php

test('authenticated user can access file browser', function () {
    $this->actingAs($this->user);
    $this->get('/files')->assertStatus(200);
});