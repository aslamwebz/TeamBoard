<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Models\Notification;
use Illuminate\Console\Command;

final class SendPaymentReminders extends Command
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
    public function handle(): void
    {
        $days = explode(',', $this->option('days'));
        $type = $this->option('type');

        $this->info('Sending payment reminders...');

        foreach ($days as $day) {
            $day = (int) $day;

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
    private function sendOverdueReminders(int $days): void
    {
        $query = Invoice::where('due_date', '<', now()->subDays($days))
            ->where(function ($query): void {
                $query
                    ->where('status', '!=', InvoiceStatus::PAID->value)
                    ->where('status', '!=', InvoiceStatus::CANCELLED->value);
            })
            ->where('status', '!=', InvoiceStatus::CANCELLED->value);

        $overdueInvoices = $query->get();

        foreach ($overdueInvoices as $invoice) {
            // Check if a reminder was already sent for this specific day
            $reminderExists = Notification::where('notifiable_type', $invoice->client::class)
                ->where('notifiable_id', $invoice->client->id)
                ->where('data->type', 'payment_reminder')
                ->where('data->invoice_id', $invoice->id)
                ->where('data->days_overdue', $days)
                ->exists();

            if (! $reminderExists) {
                // Create notification
                Notification::create([
                    'notifiable_type' => $invoice->client::class,
                    'notifiable_id' => $invoice->client->id,
                    'type' => 'payment_reminder',
                    'data' => [
                        'type' => 'payment_reminder',
                        'title' => 'Payment Reminder - Invoice '.$invoice->invoice_number,
                        'message' => sprintf('Invoice %s is %d days overdue. Amount: %s ', $invoice->invoice_number, $days, $invoice->getDefaultCurrency()).number_format($invoice->getRemainingBalance(), 2),
                        'invoice_id' => $invoice->id,
                        'invoice_number' => $invoice->invoice_number,
                        'amount' => $invoice->getRemainingBalance(),
                        'due_date' => $invoice->due_date->format('Y-m-d'),
                        'days_overdue' => $days,
                        'url' => route('invoices.show', $invoice),
                    ],
                ]);

                $this->info(sprintf('Reminder sent for invoice %s (%d days overdue)', $invoice->invoice_number, $days));
            }
        }
    }

    /**
     * Send reminders for upcoming invoices
     */
    private function sendUpcomingReminders(int $days): void
    {
        $query = Invoice::where('due_date', now()->addDays($days))
            ->where('due_date', '>', now())
            ->where('status', '!=', InvoiceStatus::PAID->value)
            ->where('status', '!=', InvoiceStatus::CANCELLED->value);

        $upcomingInvoices = $query->get();

        foreach ($upcomingInvoices as $invoice) {
            // Check if a reminder was already sent for this specific day
            $reminderExists = Notification::where('notifiable_type', $invoice->client::class)
                ->where('notifiable_id', $invoice->client->id)
                ->where('data->type', 'payment_reminder')
                ->where('data->invoice_id', $invoice->id)
                ->where('data->days_until_due', $days)
                ->exists();

            if (! $reminderExists) {
                // Create notification
                Notification::create([
                    'notifiable_type' => $invoice->client::class,
                    'notifiable_id' => $invoice->client->id,
                    'type' => 'payment_reminder',
                    'data' => [
                        'type' => 'payment_reminder',
                        'title' => 'Upcoming Payment - Invoice '.$invoice->invoice_number,
                        'message' => sprintf('Invoice %s is due in %d days. Amount: %s ', $invoice->invoice_number, $days, $invoice->getDefaultCurrency()).number_format($invoice->getRemainingBalance(), 2),
                        'invoice_id' => $invoice->id,
                        'invoice_number' => $invoice->invoice_number,
                        'amount' => $invoice->getRemainingBalance(),
                        'due_date' => $invoice->due_date->format('Y-m-d'),
                        'days_until_due' => $days,
                        'url' => route('invoices.show', $invoice),
                    ],
                ]);

                $this->info(sprintf('Upcoming reminder sent for invoice %s (due in %d days)', $invoice->invoice_number, $days));
            }
        }
    }
}
