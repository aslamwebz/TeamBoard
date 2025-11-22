<?php

namespace App\Livewire\Files\Pond;

use Livewire\Component;
use Spatie\LivewireFilepond\Components\Filepond;

class FilePondUpload extends Filepond
{
    public $acceptedFileTypes = [
        'image/jpeg',
        'image/png', 
        'image/gif',
        'image/webp',
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'application/vnd.ms-excel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'text/plain',
        'text/csv',
        'application/zip',
        'application/x-rar-compressed',
        'application/x-7z-compressed',
    ];
    
    public $maxFileSize = 10; // 10MB
    
    public $multiple = true;
    
    public $uploadUrl;
    public $entityType; // project, task, discussion, client
    public $entityId;   // ID of the entity to attach to

    public function mount($entityType = null, $entityId = null, $uploadUrl = null)
    {
        $this->entityType = $entityType;
        $this->entityId = $entityId;
        $this->uploadUrl = $uploadUrl ?: route('filepond.upload');
    }

    public function render()
    {
        return view('livewire.files.pond.file-pond-upload');
    }
    
    public function saveFiles()
    {
        // Get the uploaded files
        $files = $this->getFiles();
        
        $fileUploadService = new \App\Services\FileUploadService();
        $results = [];
        
        foreach ($files as $file) {
            $results[] = $fileUploadService->upload(
                $file, 
                auth()->id(), 
                $this->entityType === 'discussion' ? $this->entityId : null,
                null
            );
        }
        
        return $results;
    }
}