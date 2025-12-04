<?php

test('authenticated user can access team index', function () {
    $this->actingAs($this->user);
    $this->get('/teams')->assertStatus(200);
});