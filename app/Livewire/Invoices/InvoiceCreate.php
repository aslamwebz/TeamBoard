<?php

namespace App\Livewire\Invoices;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Create Invoice')]
class InvoiceCreate extends Component
{
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

    public function mount()
    {
        $this->invoice_number = 'INV-' . date('Y') . '-' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $this->issue_date = now()->format('Y-m-d');
        $this->due_date = now()->addDays(30)->format('Y-m-d');
    }

    public function createInvoice()
    {
        $validated = $this->validate();

        // Calculate total
        $validated['total'] = $validated['amount'] + $validated['tax'];

        $invoice = Invoice::create($validated);

        // Notify the user who created the invoice
        \App\Events\NewInvoiceNotification::dispatch($invoice, auth()->user());

        return $this->redirectRoute('invoices.index', navigate: true);
    }

    public function calculateTotal()
    {
        $this->total = (float)$this->amount + (float)$this->tax;
    }

    public function render()
    {
        $clients = Client::all();
        $projects = Project::all();

        return view('livewire.invoices.create', [
            'clients' => $clients,
            'projects' => $projects
        ]);
    }
}