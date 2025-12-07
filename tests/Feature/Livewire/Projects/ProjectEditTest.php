<?php

declare(strict_types=1);

test('authenticated user can access project edit', function () {
    $this->actingAs($this->user);
    $this->get('/projects/1/edit')->assertStatus(404);
});
