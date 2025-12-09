<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Models\DiscussionAttachment;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
final class FilePreview extends Component
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

    /**
     * @return mixed[]
     */
    public function getFilePreviewData($file): array
    {
        if (! $file) {
            return [];
        }

        $filePath = 'discussions/'.$file->filename;
        $fileUrl = $file->getUrl();
        $fileName = $file->original_name;
        $type = \Illuminate\Support\Facades\Storage::disk('public')->mimeType($filePath);

        // Format file size
        $size = \Illuminate\Support\Facades\Storage::disk('public')->size($filePath);
        $base = log($size) / log(1024);
        $suffixes = [' bytes', ' KB', ' MB', ' GB', ' TB'];
        $fileSizeFormatted = round(1024 ** ($base - floor($base)), 2).$suffixes[floor($base)];

        // Set icon based on file type
        $iconClass = 'fa-solid fa-file';
        $fileType = explode('/', (string) $type)[0];
        switch ($fileType) {
            case 'image':
                $iconClass = 'fa-solid fa-file-image';
                break;
            case 'audio':
                $iconClass = 'fa-solid fa-file-audio';
                break;
            case 'video':
                $iconClass = 'fa-solid fa-file-video';
                break;
            case 'application':
                $iconClass = match ($type) {
                    'application/pdf' => 'fa-solid fa-file-pdf',
                    'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'fa-solid fa-file-word',
                    'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'fa-solid fa-file-excel',
                    'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'fa-solid fa-file-powerpoint',
                    default => 'fa-solid fa-file',
                };

                break;
            case 'text':
                $iconClass = 'fa-solid fa-file-alt';
                break;
            default:
                $iconClass = 'fa-solid fa-file';
                break;
        }

        // Determine the appropriate view based on file type
        $viewData = [
            'fileName' => $fileName,
            'fileUrl' => $fileUrl,
            'type' => $type,
            'fileData' => [],
            'metadata' => ['size' => $size],
            'iconClass' => $iconClass,
            'filesizenyteformat' => $fileSizeFormatted,
        ];

        return $viewData;
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view('livewire.components.file-preview');
    }
}
