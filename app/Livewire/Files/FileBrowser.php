<?php

namespace App\Livewire\Files;

use App\Models\DiscussionAttachment;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileBrowser extends Component
{
    use WithFileUploads;

    public $files = [];
    public $selectedFiles = [];
    public $uploading = false;
    public $maxFileSize = 10485760; // 10MB in bytes
    public $allowedFileTypes = [
        'image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml',
        'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'text/plain', 'text/csv', 'application/zip', 'application/x-rar-compressed',
        'application/x-7z-compressed', 'application/x-tar', 'application/gzip', 'application/json'
    ];

    public $showModal = false;
    public $currentFolder = 'discussions';

    protected $listeners = [
        'openFileBrowser' => 'openModal',
        'closeFileBrowser' => 'closeModal',
        'attachFile' => 'attachFile'
    ];

    public function mount()
    {
        $this->loadFiles();
    }

    public function loadFiles()
    {
        // For now, we'll load from the discussions directory
        // In a real implementation, this would load from the database
        $this->files = DiscussionAttachment::orderBy('created_at', 'desc')->get();
    }

    public function updatedFiles()
    {
        foreach ($this->files as $file) {
            $this->validateOnly('files.*', [
                'files.*' => 'file|max:10240|mimes:jpeg,png,gif,webp,svg,pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,zip,rar,7z,tar,gz,json'
            ]);
        }
    }

    public function uploadFiles($discussionId = null, $commentId = null, $userId)
    {
        $this->validate([
            'files.*' => 'file|max:10240'
        ]);

        $fileUploadService = new \App\Services\FileUploadService();

        foreach ($this->files as $file) {
            $fileUploadService->upload($file, $userId, $discussionId, $commentId);
        }

        $this->files = [];
        $this->loadFiles(); // Refresh the file list
        
        $this->dispatch('filesUploaded');
    }

    public function downloadFile($fileId)
    {
        $attachment = DiscussionAttachment::find($fileId);
        
        if (!$attachment) {
            return;
        }

        $filePath = storage_path('app/discussions/' . $attachment->filename);
        
        if (!file_exists($filePath)) {
            return;
        }

        return response()->download($filePath, $attachment->original_name);
    }

    public function deleteFile($fileId)
    {
        $attachment = DiscussionAttachment::find($fileId);
        
        if ($attachment) {
            $fileUploadService = new \App\Services\FileUploadService();
            $fileUploadService->deleteAttachment($attachment);
            $this->loadFiles(); // Refresh the file list
        }
    }

    public function openModal()
    {
        $this->showModal = true;
        $this->loadFiles();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->files = [];
    }

    public function attachFile($fileId)
    {
        $this->selectedFiles[] = $fileId;
    }

    public function removeSelectedFile($index)
    {
        unset($this->selectedFiles[$index]);
        $this->selectedFiles = array_values($this->selectedFiles);
    }

    public function render()
    {
        return view('livewire.files.file-browser');
    }
}