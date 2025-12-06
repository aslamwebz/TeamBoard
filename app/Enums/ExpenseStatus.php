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

    public function getColorClass(): string
    {
        return match ($this) {
            self::PENDING => 'bg-yellow-100 text-yellow-800',
            self::APPROVED => 'bg-green-100 text-green-800',
            self::REJECTED => 'bg-red-100 text-red-800',
            self::PAID => 'bg-green-100 text-green-800',
            self::CANCELLED => 'bg-gray-100 text-gray-800',
        };
    }
}