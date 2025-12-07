<?php

declare(strict_types=1);

test('authenticated user can access milestone edit', function () {
    $this->actingAs($this->user);
    $this->get('/milestones/1/edit')->assertStatus(404);
});
