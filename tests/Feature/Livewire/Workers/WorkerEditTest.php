<?php

declare(strict_types=1);

test('authenticated user can access worker edit', function () {
    $this->actingAs($this->user);
    $this->get('/workers/1/edit')->assertStatus(404);
});
