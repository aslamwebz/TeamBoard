<?php

namespace App\Livewire\Components;

use App\Models\DiscussionAttachment;
use Livewire\Component;

class FilePreviewModal extends Component
{
    public ?DiscussionAttachment $file = null;
    public bool $showPreviewModal = false;

    protected $listeners = [
        'openFilePreview' => 'openPreview',
        'closeFilePreview' => 'closePreview'
    ];

    public function openPreview($fileId)
    {
        $file = DiscussionAttachment::find($fileId);
        if ($file) {
            // Redirect to the preview page in a new tab
            $this->js("window.open('" . route('tenant.file.preview.page', ['filename' => $file->filename]) . "', '_blank')");
        }
    }

    public function closePreview()
    {
        $this->showPreviewModal = false;
        $this->file = null;
    }

    public function render()
    {
        // This component now opens the preview page in a new tab, so no need to render anything
        return view('livewire.components.file-preview-modal');
    }
}