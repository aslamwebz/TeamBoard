<?php declare(strict_types=1);

namespace App\Enums;

enum ReportStatus: string
{
    case DRAFT = 'draft';
    case GENERATED = 'generated';
    case ARCHIVED = 'archived';

    public function getColorClass(): string
    {
        return match ($this) {
            self::DRAFT => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
            self::GENERATED => 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-300',
            self::ARCHIVED => 'bg-purple-100 text-purple-800 dark:bg-purple-700 dark:text-purple-300',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::DRAFT => 'Draft',
            self::GENERATED => 'Generated',
            self::ARCHIVED => 'Archived',
        };
    }

    /**
     * Get all statuses as array for form selects
     */
    public static function toArray(): array
    {
        return array_reduce(self::cases(), function (array $carry, \App\Enums\ReportStatus $case): array {
            $carry[$case->value] = $case->getLabel();
            return $carry;
        }, []);
    }
}
