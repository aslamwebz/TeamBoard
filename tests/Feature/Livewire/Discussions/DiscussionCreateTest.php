<?php

test('authenticated user can access discussion create', function () {
    $this->actingAs($this->user);
    $this->get('/discussions/create')->assertStatus(200);
});