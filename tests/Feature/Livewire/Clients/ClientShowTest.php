<?php

declare(strict_types=1);

test('authenticated user can access client show', function () {
    $this->actingAs($this->user);
    $this->get('/clients/1')->assertStatus(404);
});
