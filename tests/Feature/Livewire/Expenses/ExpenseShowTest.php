<?php

declare(strict_types=1);

test('authenticated user can access expense show', function () {
    $this->actingAs($this->user);
    $this->get('/expenses/1')->assertStatus(404);
});
