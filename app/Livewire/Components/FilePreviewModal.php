<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Models\DiscussionAttachment;
use Livewire\Component;

final class FilePreviewModal extends Component
{
    public ?DiscussionAttachment $file = null;

    public bool $showPreviewModal = false;

    protected $listeners = [
        'openFilePreview' => 'openPreview',
        'closeFilePreview' => 'closePreview',
    ];

    public function openPreview($fileId): void
    {
        $file = DiscussionAttachment::find($fileId);
        if ($file) {
            // Redirect to the preview page in a new tab
            $this->js("window.open('".route('tenant.file.preview.page', ['filename' => $file->filename])."', '_blank')");
        }
    }

    public function closePreview(): void
    {
        $this->showPreviewModal = false;
        $this->file = null;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        // This component now opens the preview page in a new tab, so no need to render anything
        return view('livewire.components.file-preview-modal');
    }

    public function getFilePreviewData($file)
    {
        if (!$file) {
            return [];
        }

        $filePath = 'discussions/' . $file->filename;
        $fileUrl = $file->getUrl();
        $fileName = $file->original_name;
        $type = \Illuminate\Support\Facades\Storage::disk('public')->mimeType($filePath);

        // Determine the appropriate view based on file type
        $viewData = [
            'fileName' => $fileName,
            'fileUrl' => $fileUrl,
            'type' => $type,
        ];

        return $viewData;
    }
}
