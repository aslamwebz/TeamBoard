<?php

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Invoices')]
class InvoiceIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $status_filter = '';
    public $client_filter = '';
    public $per_page = 10;
    public $confirmingDelete = false;
    public $invoiceToDeleteId;

    protected $queryString = ['search', 'status_filter', 'client_filter', 'per_page'];

    public function render()
    {
        $invoices = Invoice::query()
            ->where(function ($query) {
                $query
                    ->where('invoice_number', 'like', '%' . $this->search . '%')
                    ->orWhereHas('client', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->status_filter, function ($query) {
                $query->where('status', $this->status_filter);
            })
            ->when($this->client_filter, function ($query) {
                $query->where('client_id', $this->client_filter);
            })
            ->with(['client', 'project'])
            ->orderBy('created_at', 'desc')
            ->paginate($this->per_page);

        $clients = \App\Models\Client::orderBy('name')->get();

        return view('livewire.invoices.index', [
            'invoices' => $invoices,
            'clients' => $clients
        ]);
    }

    public function deleteInvoice($id)
    {
        $this->invoiceToDeleteId = $id;
        $this->confirmingDelete = true;
    }

    public function confirmDelete()
    {
        $invoice = Invoice::find($this->invoiceToDeleteId);
        if ($invoice) {
            $invoice->delete();
        }

        $this->confirmingDelete = false;
        $this->invoiceToDeleteId = null;
    }

    public function cancelDelete()
    {
        $this->confirmingDelete = false;
        $this->invoiceToDeleteId = null;
    }
}
