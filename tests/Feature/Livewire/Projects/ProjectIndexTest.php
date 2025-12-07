<?php

declare(strict_types=1);

test('authenticated user can access project index', function () {
    $this->actingAs($this->user);
    $this->get('/projects')->assertStatus(200);
});
