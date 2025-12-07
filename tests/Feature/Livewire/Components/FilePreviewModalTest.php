<?php

declare(strict_types=1);

use Livewire\Livewire;

test('can instantiate file preview modal component', function () {
    $this->actingAs($this->user);
    Livewire::test(App\Livewire\Components\FilePreviewModal::class)
        ->assertStatus(200);
});
