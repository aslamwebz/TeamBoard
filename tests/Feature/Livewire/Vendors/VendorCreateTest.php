<?php

declare(strict_types=1);

test('authenticated user can access vendor create', function () {
    $this->actingAs($this->user);
    $this->get('/vendors/create')->assertStatus(200);
});
