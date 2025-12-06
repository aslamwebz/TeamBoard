<?php

declare(strict_types=1);

namespace App\Enums;

enum VendorStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case PENDING = 'pending';

    public function getColorClass(): string
    {
        return match ($this) {
            self::ACTIVE => 'bg-green-100 text-green-800',
            self::INACTIVE => 'bg-red-100 text-red-800',
            self::PENDING => 'bg-yellow-100 text-yellow-800',
        };
    }
}