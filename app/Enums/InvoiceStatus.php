<?php

declare(strict_types=1);

namespace App\Enums;

enum InvoiceStatus: string
{
    case DRAFT = 'draft';
    case SENT = 'sent';
    case PAID = 'paid';
    case OVERDUE = 'overdue';

    public function getColorClass(): string
    {
        return match ($this) {
            self::DRAFT => 'bg-gray-500/10 text-gray-700 dark:text-gray-400',
            self::SENT => 'bg-blue-500/10 text-blue-700 dark:text-blue-400',
            self::PAID => 'bg-green-500/10 text-green-700 dark:text-green-400',
            self::OVERDUE => 'bg-red-500/10 text-red-700 dark:text-red-400',
        };
    }
}