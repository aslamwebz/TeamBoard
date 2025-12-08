<?php declare(strict_types=1);

use App\Livewire\Components\FilePreviewModal;
use Livewire\Livewire;

test('can instantiate file preview modal component', function () {
    $this->actingAs($this->user);
    Livewire::test(FilePreviewModal::class)
        ->assertStatus(200);
});
