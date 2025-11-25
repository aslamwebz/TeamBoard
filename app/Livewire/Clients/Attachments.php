<?php

declare(strict_types=1);

namespace App\Livewire\Clients;

use App\Models\Client;
use App\Models\ClientAttachment;
use Livewire\Component;
use Livewire\WithFileUploads;

class Attachments extends Component
{
    use WithFileUploads;

    public Client $client;
    public $attachments;
    public $uploadForm = false;
    public $uploadedFiles = [];
    
    #[Validate('required')]
    public $files = [];
    
    #[Validate('nullable|string|max:255')]
    public string $attachment_type = 'document';
    
    #[Validate('nullable|string')]
    public string $description = '';

    protected $rules = [
        'files.*' => 'required|file|max:10240', // 10MB max
        'attachment_type' => 'required|string|max:50',
        'description' => 'nullable|string|max:1000',
    ];

    public function mount(Client $client)
    {
        $this->client = $client;
        $this->attachments = $this->client->attachments()->latest()->get();
    }

    public function updatedFiles()
    {
        $this->validateOnly('files');
    }

    public function addAttachments()
    {
        $validatedData = $this->validate();
        
        foreach ($this->files as $file) {
            // Store the file
            $path = $file->store('client-attachments/' . $this->client->id, 'public');
            
            // Create attachment record
            $this->client->attachments()->create([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'type' => $validatedData['attachment_type'],
                'description' => $validatedData['description'],
                'uploaded_by' => auth()->id(),
                'uploaded_at' => now(),
            ]);
        }

        // Refresh attachments
        $this->attachments = $this->client->attachments()->latest()->get();
        
        // Reset form
        $this->reset(['files', 'attachment_type', 'description', 'uploadForm']);
        
        session()->flash('message', count($this->files) . ' file(s) uploaded successfully.');
    }

    public function deleteAttachment($attachmentId)
    {
        $attachment = $this->client->attachments()->findOrFail($attachmentId);
        $attachment->delete();
        
        // Delete the physical file
        if (\Storage::exists($attachment->path)) {
            \Storage::delete($attachment->path);
        }
        
        // Refresh attachments
        $this->attachments = $this->client->attachments()->latest()->get();
        
        session()->flash('message', 'Attachment deleted successfully.');
    }

    public function render()
    {
        return view('livewire.clients.attachments');
    }
}