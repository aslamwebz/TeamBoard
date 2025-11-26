<?php

namespace App\Livewire\Expenses;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ExpenseAttachment;

class ExpenseAttachments extends Component
{
    use WithFileUploads;

    public Expense $expense;
    public $attachments = [];
    public $newAttachment;

    public function mount(Expense $expense)
    {
        $this->expense = $expense;
    }

    public function addAttachment()
    {
        $this->validate([
            'newAttachment' => 'required|file|max:10240', // Max 10MB
        ]);

        foreach ($this->newAttachment as $file) {
            $path = $file->store('expense-attachments/' . date('Y/m'), 'public');
            
            ExpenseAttachment::create([
                'expense_id' => $this->expense->id,
                'filename' => $file->getClientOriginalName(),
                'original_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);
        }

        $this->newAttachment = null;
        $this->dispatch('attachment-added');
    }

    public function deleteAttachment($attachmentId)
    {
        $attachment = ExpenseAttachment::find($attachmentId);
        if ($attachment && $attachment->expense_id === $this->expense->id) {
            // Delete the file from storage
            \Storage::disk('public')->delete($attachment->file_path);
            
            $attachment->delete();
            $this->dispatch('attachment-deleted');
        }
    }

    public function render()
    {
        $attachments = $this->expense->attachments()->orderBy('created_at', 'desc')->get();
        
        return view('livewire.expenses.expense-attachments', [
            'attachments' => $attachments,
        ])->layout('components.layouts.app');
    }
}