<?php

declare(strict_types=1);

namespace App\Enums;

enum PurchaseOrderStatus: string
{
    case DRAFT = 'draft';
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case SENT = 'sent';
    case PARTIALLY_RECEIVED = 'partially_received';
    case RECEIVED = 'received';
    case CLOSED = 'closed';
    case CANCELLED = 'cancelled';

    public function getColorClass(): string
    {
        return match ($this) {
            self::DRAFT => 'bg-blue-100 text-blue-800',
            self::PENDING => 'bg-yellow-100 text-yellow-800',
            self::APPROVED => 'bg-green-100 text-green-800',
            self::SENT => 'bg-purple-100 text-purple-800',
            self::PARTIALLY_RECEIVED => 'bg-indigo-100 text-indigo-800',
            self::RECEIVED => 'bg-green-100 text-green-800',
            self::CLOSED => 'bg-gray-100 text-gray-800',
            self::CANCELLED => 'bg-red-100 text-red-800',
        };
    }
}
