<?php

test('authenticated user can access appearance settings', function () {
    $this->actingAs($this->user);
    $this->get('/settings/appearance')->assertStatus(200);
});