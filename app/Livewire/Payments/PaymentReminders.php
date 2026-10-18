<?php

declare(strict_types=1);

namespace App\Livewire\Payments;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
final class PaymentReminders extends Component
{
    use WithPagination;

    public $filter = 'overdue';  // overdue, upcoming, all

    public function render()
    {
        $invoices = Invoice::with(['client', 'payments'])
            ->where('status', '!=', InvoiceStatus::PAID->value)
            ->where('status', '!=', InvoiceStatus::CANCELLED->value);

        $invoices = match ($this->filter) {
            'overdue' => $invoices
                ->where('due_date', '<', now())
                ->where(function ($query): void {
                    $query
                        ->where('status', '!=', InvoiceStatus::PAID->value)
                        ->orWhere('status', InvoiceStatus::PARTIALLY_PAID->value);
                }),
            'upcoming' => $invoices->where('due_date', '>=', now()),
            default => $invoices,
        };

        $invoices = $invoices->orderBy('due_date', 'asc')->paginate(10);

        // Get statistics
        $totalOverdue = Invoice::where('due_date', '<', now())
            ->where(function ($query): void {
                $query
                    ->where('status', '!=', InvoiceStatus::PAID->value)
                    ->where('status', '!=', InvoiceStatus::CANCELLED->value);
            })
            ->sum('total');

        $totalUpcoming = Invoice::where('due_date', '>=', now())
            ->where('status', '!=', InvoiceStatus::PAID->value)
            ->where('status', '!=', InvoiceStatus::CANCELLED->value)
            ->sum('total');

        $overdueCount = Invoice::where('due_date', '<', now())
            ->where(function ($query): void {
                $query
                    ->where('status', '!=', InvoiceStatus::PAID->value)
                    ->where('status', '!=', InvoiceStatus::CANCELLED->value);
            })
            ->count();

        return view('livewire.payments.payment-reminders', [
            'invoices' => $invoices,
            'totalOverdue' => $totalOverdue,
            'totalUpcoming' => $totalUpcoming,
            'overdueCount' => $overdueCount,
        ])->layout('components.layouts.app');
    }

    public function sendReminder($invoiceId): void
    {
        $invoice = Invoice::find($invoiceId);
        if ($invoice) {
            // In a real app, you would send an email notification here
            // For now, we'll just log it
            Log::info('Payment reminder sent for invoice '.$invoice->invoice_number);

            $this->dispatch('reminder-sent', message: 'Reminder sent successfully');
        }
    }
}
