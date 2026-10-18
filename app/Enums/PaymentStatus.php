<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentStatus: string
{
    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';
    case CANCELLED = 'cancelled';

    /**
     * Get all statuses as array for form selects
     */
    public static function toArray(): array
    {
        return array_reduce(self::cases(), function (array $carry, PaymentStatus $case): array {
            $carry[$case->value] = $case->getLabel();

            return $carry;
        }, []);
    }

    public function getColorClass(): string
    {
        return match ($this) {
            self::PENDING => 'bg-yellow-100 text-yellow-800',
            self::PROCESSING => 'bg-blue-100 text-blue-800',
            self::COMPLETED => 'bg-green-100 text-green-800',
            self::FAILED => 'bg-red-100 text-red-800',
            self::REFUNDED => 'bg-orange-100 text-orange-800',
            self::CANCELLED => 'bg-gray-100 text-gray-800',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::PROCESSING => 'Processing',
            self::COMPLETED => 'Completed',
            self::FAILED => 'Failed',
            self::REFUNDED => 'Refunded',
            self::CANCELLED => 'Cancelled',
        };
    }
}
