<?php

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Invoices')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';
    public $showDeleteModal = false;
    public $invoiceToDeleteId;

    protected $queryString = ['search', 'statusFilter'];

    public function render()
    {
        $invoices = Invoice::query()
            ->where('invoice_number', 'like', '%' . $this->search . '%')
            ->orWhereHas('client', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->with(['client', 'project'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $statuses = [
            '' => 'All Statuses',
            'draft' => 'Draft',
            'sent' => 'Sent',
            'paid' => 'Paid',
            'overdue' => 'Overdue',
            'cancelled' => 'Cancelled'
        ];

        return view('livewire.invoices.index', [
            'invoices' => $invoices,
            'statuses' => $statuses
        ]);
    }

    public function deleteInvoice($id)
    {
        $this->invoiceToDeleteId = $id;
        $this->showDeleteModal = true;
    }

    public function confirmDelete()
    {
        $invoice = Invoice::find($this->invoiceToDeleteId);
        if ($invoice) {
            $invoice->delete();
        }

        $this->showDeleteModal = false;
        $this->invoiceToDeleteId = null;
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->invoiceToDeleteId = null;
    }

    public function updateStatusFilter($status)
    {
        $this->statusFilter = $status;
    }
}