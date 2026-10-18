<?php

declare(strict_types=1);

use App\Livewire\Clients\Attachments;

test('client attachments component class exists', function () {
    $componentClass = Attachments::class;
    expect(class_exists($componentClass))->toBeTrue();
});
