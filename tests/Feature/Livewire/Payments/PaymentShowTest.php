<?php

test('authenticated user can access payment show', function () {
    $this->actingAs($this->user);
    $this->get('/payments/1')->assertStatus(404);
});