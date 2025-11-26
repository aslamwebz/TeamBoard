<?php

namespace App\Livewire\Files;

use App\Models\DiscussionAttachment;
use App\Models\FileAttachment;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('File Browser')]
class FilesIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $type = ''; // image, document, etc.
    public $sortBy = 'created_at'; // created_at, name, size
    public $sortDirection = 'desc';
    public function render(): \Illuminate\Contracts\View\View
    {
        // Get all attachments across different attachment tables
        // Initially, we'll just use the DiscussionAttachment table since FileAttachment might not be fully implemented yet
        $query = DiscussionAttachment::with(['user', 'discussion', 'comment']);

        // Apply search filter
        $query->where(function($q) {
            $q->where('original_name', 'like', '%' . $this->search . '%')
              ->orWhere('mime_type', 'like', '%' . $this->search . '%');
        });

        // Apply type filter
        if ($this->type) {
            if ($this->type === 'image') {
                $query->where('mime_type', 'like', 'image/%');
            } elseif ($this->type === 'document') {
                $query->where(function($q) {
                    $q->where('mime_type', 'application/pdf')
                      ->orWhere('mime_type', 'application/msword')
                      ->orWhere('mime_type', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
                      ->orWhere('mime_type', 'application/vnd.ms-excel')
                      ->orWhere('mime_type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
                      ->orWhere('mime_type', 'text/plain')
                      ->orWhere('mime_type', 'text/csv');
                });
            }
        }

        // Order and paginate
        $files = $query->orderBy($this->sortBy, $this->sortDirection)
                       ->paginate(20);

        return view('livewire.files.files-index', [
            'files' => $files
        ]);
    }
}