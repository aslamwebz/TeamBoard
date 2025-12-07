<?php

declare(strict_types=1);

namespace App\Livewire\Expenses;

use App\Models\Expense;
use App\Models\ExpenseAttachment;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
#[Title('Expense Attachments')]
final class ExpenseAttachments extends Component
{
    use WithFileUploads;

    public Expense $expense;

    public $attachments = [];

    public $newAttachment;

    public function mount(Expense $expense): void
    {
        $this->expense = $expense;
    }

    public function addAttachment(): void
    {
        $this->validate([
            'newAttachment' => 'required|file|max:10240', // Max 10MB
        ]);

        foreach ($this->newAttachment as $file) {
            $path = $file->store('expense-attachments/'.date('Y/m'), 'public');

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

    public function deleteAttachment($attachmentId): void
    {
        $attachment = ExpenseAttachment::find($attachmentId);
        if ($attachment && $attachment->expense_id === $this->expense->id) {
            // Delete the file from storage
            Storage::disk('public')->delete($attachment->file_path);

            $attachment->delete();
            $this->dispatch('attachment-deleted');
        }
    }

    public function render(): View
    {
        $attachments = $this->expense
            ->attachments()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.expenses.expense-attachments', [
            'attachments' => $attachments,
        ]);
    }
}
