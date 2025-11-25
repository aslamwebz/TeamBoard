<?php

namespace App\Livewire\Invoices;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Edit Invoice')]
class InvoiceEdit extends Component
{
    public $invoice;
    public $invoiceId;
    public $client_id = '';
    public $project_id = '';
    public $invoice_number = '';
    public $issue_date = '';
    public $due_date = '';
    public $amount = '';
    public $tax = '';
    public $total = '';
    public $status = 'draft';
    public $description = '';

    protected $rules = [
        'client_id' => 'required|exists:clients,id',
        'project_id' => 'nullable|exists:projects,id',
        'invoice_number' => 'required|string|unique:invoices,invoice_number',
        'issue_date' => 'required|date',
        'due_date' => 'required|date|after_or_equal:issue_date',
        'amount' => 'required|numeric|min:0',
        'tax' => 'required|numeric|min:0',
        'total' => 'required|numeric|min:0',
        'status' => 'required|in:draft,sent,paid,overdue,cancelled',
        'description' => 'nullable|string|max:500',
    ];

    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->invoiceId = $invoice->id;
        $this->client_id = $invoice->client_id;
        $this->project_id = $invoice->project_id;
        $this->invoice_number = $invoice->invoice_number;
        $this->issue_date = $invoice->issue_date->format('Y-m-d');
        $this->due_date = $invoice->due_date->format('Y-m-d');
        $this->amount = $invoice->amount;
        $this->tax = $invoice->tax;
        $this->total = $invoice->total;
        $this->status = $invoice->status;
        $this->description = $invoice->description;
    }

    public function updateInvoice()
    {
        $this->rules['invoice_number'] = 'required|string|unique:invoices,invoice_number,' . $this->invoiceId;
        $validated = $this->validate();

        // Calculate total
        $validated['total'] = $validated['amount'] + $validated['tax'];

        $invoice = Invoice::find($this->invoiceId);
        if ($invoice) {
            $oldStatus = $invoice->status;
            $invoice->update($validated);

            // If invoice status changed to 'sent', notify the user who updated it
            if ($oldStatus !== $validated['status'] && $validated['status'] === 'sent') {
                \App\Events\NewInvoiceNotification::dispatch($invoice, auth()->user());
            }
        }

        return $this->redirectRoute('invoices.index', navigate: true);
    }

    public function calculateTotal()
    {
        $this->total = (float) $this->amount + (float) $this->tax;
    }

    public function render()
    {
        $clients = Client::all();
        $projects = Project::all();

        return view('livewire.invoices.edit', [
            'clients' => $clients,
            'projects' => $projects
        ]);
    }
}
