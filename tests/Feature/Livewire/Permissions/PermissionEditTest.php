<?php

test('authenticated user can access permission edit when exists', function () {
    $this->actingAs($this->user);
    $this->get('/permissions/1/edit')->assertStatus(200);
});