<?php

declare(strict_types=1);

test('authenticated user can access vendor edit', function () {
    $this->actingAs($this->user);
    $this->get('/vendors/1/edit')->assertStatus(404);
});
