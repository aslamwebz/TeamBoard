<?php

namespace App\Livewire\Components;

use App\Models\DiscussionAttachment;
use Livewire\Component;
use Livewire\Attributes\Lazy;

#[Lazy]
class FilePreview extends Component
{
    public DiscussionAttachment $file;
    public bool $showPreview = false;
    public bool $showModal = false;

    public function mount(DiscussionAttachment $file): void
    {
        $this->file = $file;
    }

    public function openPreview(): void
    {
        $this->showModal = true;
    }

    public function closePreview(): void
    {
        $this->showModal = false;
    }

    public function canPreview(): bool
    {
        // Check if the file type can be previewed in browser
        $previewableTypes = [
            'image/jpeg',
            'image/jpg',
            'image/png',
            'image/gif',
            'image/webp',
            'image/svg+xml',
            'application/pdf',
            'text/plain',
        ];

        return in_array($this->file->mime_type, $previewableTypes);
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.components.file-preview');
    }
}