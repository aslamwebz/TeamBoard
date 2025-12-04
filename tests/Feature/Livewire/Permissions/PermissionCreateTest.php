<?php

test('authenticated user can access permission create', function () {
    $this->actingAs($this->user);
    $this->get('/permissions/create')->assertStatus(200);
});