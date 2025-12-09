<?php declare(strict_types=1);

namespace App\Enums;

enum InvoiceStatus: string
{
    case DRAFT = 'draft';
    case SENT = 'sent';
    case PARTIALLY_PAID = 'partially_paid';
    case PAID = 'paid';
    case OVERDUE = 'overdue';
    case CANCELLED = 'cancelled';

    public function getColorClass(): string
    {
        return match ($this) {
            self::DRAFT => 'bg-gray-500/10 text-gray-700 dark:text-gray-400',
            self::SENT => 'bg-sky-500/10 text-blue-700 dark:text-blue-400',
            self::PARTIALLY_PAID => 'bg-yellow-500/10 text-yellow-700 dark:text-yellow-400',
            self::PAID => 'bg-green-500/10 text-green-700 dark:text-green-400',
            self::OVERDUE => 'bg-red-500/10 text-red-700 dark:text-red-400',
            self::CANCELLED => 'bg-gray-500/10 text-gray-700 dark:text-gray-400',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::SENT => 'Sent',
            self::PARTIALLY_PAID => 'Partially Paid',
            self::PAID => 'Paid',
            self::OVERDUE => 'Overdue',
            self::CANCELLED => 'Cancelled',
        };
    }

    /**
     * Get all statuses as array for form selects
     */
    public static function toArray(): array
    {
        return array_reduce(self::cases(), function (array $carry, \App\Enums\InvoiceStatus $case): array {
            $carry[$case->value] = $case->getLabel();
            return $carry;
        }, []);
    }
}
