<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Schedule the payment reminder command to run daily
        $schedule->command('reminders:send-payment --type=overdue')
                 ->dailyAt('09:00')
                 ->timezone('UTC')
                 ->description('Send automated payment reminders for overdue invoices');

        // Schedule the payment reminder command for upcoming invoices weekly
        $schedule->command('reminders:send-payment --type=upcoming --days=7')
                 ->weeklyOn(1, '09:00') // Every Monday at 9 AM
                 ->timezone('UTC')
                 ->description('Send automated payment reminders for upcoming invoices');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        
        require base_path('routes/console.php');
    }
}