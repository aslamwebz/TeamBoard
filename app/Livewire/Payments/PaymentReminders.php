<?php

namespace App\Livewire\Payments;

use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentReminders extends Component
{
    use WithPagination;

    public $filter = 'overdue'; // overdue, upcoming, all

    public function render()
    {
        $invoices = Invoice::with(['client', 'payments'])
            ->where('status', '!=', Invoice::STATUS_PAID)
            ->where('status', '!=', Invoice::STATUS_CANCELLED);

        switch ($this->filter) {
            case 'overdue':
                $invoices = $invoices->where('due_date', '<', now())
                    ->where(function ($query) {
                        $query->where('status', '!=', Invoice::STATUS_PAID)
                              ->orWhere('status', Invoice::STATUS_PARTIALLY_PAID);
                    });
                break;
            case 'upcoming':
                $invoices = $invoices->where('due_date', '>=', now());
                break;
            case 'all':
            default:
                $invoices = $invoices;
                break;
        }

        $invoices = $invoices->orderBy('due_date', 'asc')->paginate(10);

        // Get statistics
        $totalOverdue = Invoice::where('due_date', '<', now())
            ->where(function ($query) {
                $query->where('status', '!=', Invoice::STATUS_PAID)
                      ->where('status', '!=', Invoice::STATUS_CANCELLED);
            })
            ->sum('total');

        $totalUpcoming = Invoice::where('due_date', '>=', now())
            ->where('status', '!=', Invoice::STATUS_PAID)
            ->where('status', '!=', Invoice::STATUS_CANCELLED)
            ->sum('total');

        $overdueCount = Invoice::where('due_date', '<', now())
            ->where(function ($query) {
                $query->where('status', '!=', Invoice::STATUS_PAID)
                      ->where('status', '!=', Invoice::STATUS_CANCELLED);
            })
            ->count();

        return view('livewire.payments.payment-reminders', [
            'invoices' => $invoices,
            'totalOverdue' => $totalOverdue,
            'totalUpcoming' => $totalUpcoming,
            'overdueCount' => $overdueCount,
        ])->layout('components.layouts.app');
    }

    public function sendReminder($invoiceId)
    {
        $invoice = Invoice::find($invoiceId);
        if ($invoice) {
            // In a real app, you would send an email notification here
            // For now, we'll just log it
            \Log::info("Payment reminder sent for invoice {$invoice->invoice_number}");
            
            $this->dispatch('reminder-sent', message: 'Reminder sent successfully');
        }
    }
}