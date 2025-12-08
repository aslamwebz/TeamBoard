<?php declare(strict_types=1);

use App\Livewire\Tasks\Dependencies\Manage;
use Livewire\Livewire;

test('can instantiate task dependencies component', function () {
    $this->actingAs($this->user);
    Livewire::test(Manage::class)
        ->assertStatus(200);
});
