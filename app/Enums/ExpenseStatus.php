<?php

declare(strict_types=1);

namespace App\Enums;

enum ExpenseStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case PAID = 'paid';
    case CANCELLED = 'cancelled';

    /**
     * Get all statuses as array for form selects
     */
    public static function toArray(): array
    {
        return array_reduce(self::cases(), function ($carry, $case) {
            $carry[$case->value] = $case->getLabel();

            return $carry;
        }, []);
    }

    public function getColorClass(): string
    {
        return match ($this) {
            self::PENDING => 'bg-yellow-100 text-yellow-800',
            self::APPROVED => 'bg-green-100 text-green-800',
            self::REJECTED => 'bg-red-100 text-red-800',
            self::PAID => 'bg-blue-100 text-blue-800',
            self::CANCELLED => 'bg-gray-100 text-gray-800',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::APPROVED => 'Approved',
            self::REJECTED => 'Rejected',
            self::PAID => 'Paid',
            self::CANCELLED => 'Cancelled',
        };
    }
}
