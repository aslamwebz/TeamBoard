<?php

declare(strict_types=1);

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Attributes\Validate;

class Attachments extends Component
{
    use WithFileUploads;

    public Client $client;
    public $attachments;
    public $uploadForm = false;
    public $uploadedFiles = [];

    public $files = [];

    public string $attachment_type = 'document';

    public string $description = '';

    protected $rules = [
        'files.*' => 'required|file|max:10240', // 10MB max
        'attachment_type' => 'required|string|max:50',
        'description' => 'nullable|string|max:1000',
    ];

    public function mount(Client $client) : void
    {
        $this->client = $client;
        $this->attachments = $this->client->attachments()->latest()->get();
    }

    public function updatedFiles() : void
    {
        $this->validateOnly('files');
    }

    public function addAttachments() : void
    {
        $validatedData = $this->validate([
            'files.*' => 'required|file|max:10240', // 10MB max
            'attachment_type' => 'required|string|max:50',
            'description' => 'nullable|string|max:1000',
        ]);

        foreach ($this->files as $file) {
            // Store the file
            $path = $file->store('client-attachments/' . $this->client->id, 'public');

            /** @var \App\Models\User $user */
            $user = Auth::user();

            // Create attachment record
            $this->client->attachments()->create([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
                'type' => $validatedData['attachment_type'],
                'description' => $validatedData['description'],
                'uploaded_by' => $user->id,
                'uploaded_at' => now(),
            ]);
        }

        // Refresh attachments
        $this->attachments = $this->client->attachments()->latest()->get();

        // Reset form
        $this->reset(['files', 'attachment_type', 'description', 'uploadForm']);

        session()->flash('message', count($this->files) . ' file(s) uploaded successfully.');
    }

    public function deleteAttachment($attachmentId) : void
    {
        /** @var \App\Models\ClientAttachment $attachment */
        $attachment = $this->client->attachments()->findOrFail($attachmentId);
        $attachment->delete();

        // Delete the physical file
        if (Storage::exists($attachment->path)) {
            \Storage::delete($attachment->path);
        }

        // Refresh attachments
        $this->attachments = $this->client->attachments()->latest()->get();

        session()->flash('message', 'Attachment deleted successfully.');
    }

    public function render() : View
    {
        return view('livewire.clients.attachments');
    }
}