<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.app')]
#[Title('Create Invoice')]
final class InvoiceCreate extends Component
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

    public function mount(): void
    {
        $this->authorize('create', Invoice::class);

        $this->invoice_number = 'INV-'.date('Y').'-'.mb_str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $this->issue_date = now()->format('Y-m-d');
        $this->due_date = now()->addDays(30)->format('Y-m-d');
    }

    public function createInvoice(): RedirectResponse
    {
        $this->authorize('create', Invoice::class);

        $validated = $this->validate([
            'client_id' => 'required|exists:clients,id',
            'project_id' => 'nullable|exists:projects,id',
            'invoice_number' => 'required|string|max:255|unique:invoices,invoice_number',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'amount' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'status' => 'required|string|in:draft,sent,paid,partially_paid,overdue,cancelled',
            'description' => 'nullable|string',
        ]);

        $validated['tax'] = (float) ($validated['tax'] ?? 0);
        $validated['total'] = (float) $validated['amount'] + $validated['tax'];

        $invoice = Invoice::create($validated);

        // Notify the user who created the invoice
        \App\Events\NewInvoiceNotification::dispatch($invoice, auth()->user());

        return $this->redirectRoute('invoices.index', navigate: true);
    }

    public function calculateTotal(): void
    {
        $this->total = (float) $this->amount + (float) $this->tax;
    }

    public function render(): View
    {
        $clients = Client::all();
        $projects = Project::all();

        return view('livewire.invoices.invoice-create', [
            'clients' => $clients,
            'projects' => $projects,
        ]);
    }
}
