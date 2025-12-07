<?php

declare(strict_types=1);

namespace App\Enums;

enum PaymentMethod: string
{
    case CASH = 'cash';
    case CREDIT_CARD = 'credit_card';
    case DEBIT_CARD = 'debit_card';
    case BANK_TRANSFER = 'bank_transfer';
    case CHECK = 'check';
    case PAYPAL = 'paypal';
    case OTHER = 'other';

    /**
     * Get all payment methods as array for form selects
     */
    public static function toArray(): array
    {
        return array_reduce(self::cases(), function ($carry, $case) {
            $carry[$case->value] = $case->getLabel();

            return $carry;
        }, []);
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::CASH => 'Cash',
            self::CREDIT_CARD => 'Credit Card',
            self::DEBIT_CARD => 'Debit Card',
            self::BANK_TRANSFER => 'Bank Transfer',
            self::CHECK => 'Check',
            self::PAYPAL => 'PayPal',
            self::OTHER => 'Other',
        };
    }
}
