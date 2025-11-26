<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use App\Models\Notification;
use Illuminate\Console\Command;

class SendPaymentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:send-payment
                            {--days=1,3,7,14,30 : Number of days before/after due date to send reminders}
                            {--type=overdue : Type of reminders to send (overdue, upcoming, all)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send automated payment reminders for overdue and upcoming invoices';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = explode(',', $this->option('days'));
        $type = $this->option('type');

        $this->info('Sending payment reminders...');

        foreach ($days as $day) {
            $day = (int)$day;

            if ($type === 'overdue' || $type === 'all') {
                $this->sendOverdueReminders($day);
            }

            if ($type === 'upcoming' || $type === 'all') {
                $this->sendUpcomingReminders($day);
            }
        }

        $this->info('Payment reminders sent successfully.');
    }

    /**
     * Send reminders for overdue invoices
     */
    private function sendOverdueReminders(int $days)
    {
        $query = Invoice::where('due_date', '<', now()->subDays($days))
                        ->where(function ($query) {
                            $query->where('status', '!=', Invoice::STATUS_PAID)
                                  ->where('status', '!=', Invoice::STATUS_CANCELLED);
                        })
                        ->where('status', '!=', Invoice::STATUS_CANCELLED);

        $overdueInvoices = $query->get();

        foreach ($overdueInvoices as $invoice) {
            // Check if a reminder was already sent for this specific day
            $reminderExists = Notification::where('notifiable_type', get_class($invoice->client))
                                         ->where('notifiable_id', $invoice->client->id)
                                         ->where('data->type', 'payment_reminder')
                                         ->where('data->invoice_id', $invoice->id)
                                         ->where('data->days_overdue', $days)
                                         ->exists();

            if (!$reminderExists) {
                // Create notification
                Notification::create([
                    'notifiable_type' => get_class($invoice->client),
                    'notifiable_id' => $invoice->client->id,
                    'type' => 'payment_reminder',
                    'data' => [
                        'type' => 'payment_reminder',
                        'title' => 'Payment Reminder - Invoice ' . $invoice->invoice_number,
                        'message' => "Invoice {$invoice->invoice_number} is {$days} days overdue. Amount: {$invoice->getDefaultCurrency()} " . number_format($invoice->getRemainingBalance(), 2),
                        'invoice_id' => $invoice->id,
                        'invoice_number' => $invoice->invoice_number,
                        'amount' => $invoice->getRemainingBalance(),
                        'due_date' => $invoice->due_date->format('Y-m-d'),
                        'days_overdue' => $days,
                        'url' => route('invoices.show', $invoice),
                    ],
                ]);

                $this->info("Reminder sent for invoice {$invoice->invoice_number} ({$days} days overdue)");
            }
        }
    }

    /**
     * Send reminders for upcoming invoices
     */
    private function sendUpcomingReminders(int $days)
    {
        $query = Invoice::where('due_date', now()->addDays($days))
                        ->where('due_date', '>', now())
                        ->where('status', '!=', Invoice::STATUS_PAID)
                        ->where('status', '!=', Invoice::STATUS_CANCELLED);

        $upcomingInvoices = $query->get();

        foreach ($upcomingInvoices as $invoice) {
            // Check if a reminder was already sent for this specific day
            $reminderExists = Notification::where('notifiable_type', get_class($invoice->client))
                                         ->where('notifiable_id', $invoice->client->id)
                                         ->where('data->type', 'payment_reminder')
                                         ->where('data->invoice_id', $invoice->id)
                                         ->where('data->days_until_due', $days)
                                         ->exists();

            if (!$reminderExists) {
                // Create notification
                Notification::create([
                    'notifiable_type' => get_class($invoice->client),
                    'notifiable_id' => $invoice->client->id,
                    'type' => 'payment_reminder',
                    'data' => [
                        'type' => 'payment_reminder',
                        'title' => 'Upcoming Payment - Invoice ' . $invoice->invoice_number,
                        'message' => "Invoice {$invoice->invoice_number} is due in {$days} days. Amount: {$invoice->getDefaultCurrency()} " . number_format($invoice->getRemainingBalance(), 2),
                        'invoice_id' => $invoice->id,
                        'invoice_number' => $invoice->invoice_number,
                        'amount' => $invoice->getRemainingBalance(),
                        'due_date' => $invoice->due_date->format('Y-m-d'),
                        'days_until_due' => $days,
                        'url' => route('invoices.show', $invoice),
                    ],
                ]);

                $this->info("Upcoming reminder sent for invoice {$invoice->invoice_number} (due in {$days} days)");
            }
        }
    }
}
