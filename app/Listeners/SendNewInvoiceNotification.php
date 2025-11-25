<?php

namespace App\Listeners;

use App\Events\NewInvoiceNotification as NewInvoiceEvent;
use App\Services\NotificationService;

class SendNewInvoiceNotification
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function handle(NewInvoiceEvent $event): void
    {
        $this->notificationService->notifyNewInvoice(
            $event->invoice,
            $event->user
        );
    }
}