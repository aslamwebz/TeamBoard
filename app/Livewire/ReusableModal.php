<?php

namespace App\Livewire;

use Livewire\Component;

class ReusableModal extends Component
{
    public $name;
    public $title;
    public $description = '';
    public $items = [];
    public $selectedItems = [];
    public $show = false;
    public $onSubmit = '';
    public $onCancel = '';
    public $submitLabel = 'Submit';
    public $cancelLabel = 'Cancel';
    public $type = 'default'; // default, confirm, assign

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.reusable-modal');
    }
}