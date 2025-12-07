<?php declare(strict_types=1);

namespace App\Enums;

enum TaskStatus: string
{
    case TODO = 'todo';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case ON_HOLD = 'on_hold';

    public function getColorClass(): string
    {
        return match ($this) {
            self::TODO => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300',
            self::IN_PROGRESS => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
            self::COMPLETED => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
            self::ON_HOLD => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
        };
    }

    public function getDarkColorClass(): string
    {
        return match ($this) {
            self::TODO => 'bg-zinc-500/10 text-zinc-700 dark:text-zinc-400',
            self::IN_PROGRESS => 'bg-sky-500/10 text-blue-700 dark:text-blue-400',
            self::COMPLETED => 'bg-green-500/10 text-green-700 dark:text-green-400',
            self::ON_HOLD => 'bg-red-500/10 text-red-700 dark:text-red-400',
        };
    }

    public function getLightColorClass(): string
    {
        return match ($this) {
            self::TODO => 'bg-gray-100 text-gray-800',
            self::IN_PROGRESS => 'bg-blue-100 text-blue-800',
            self::COMPLETED => 'bg-green-100 text-green-800',
            self::ON_HOLD => 'bg-yellow-100 text-yellow-800',
        };
    }

    public function getSimpleColorClass(): string
    {
        return match ($this) {
            self::TODO => 'bg-white text-zinc-800 dark:text-zinc-300',
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::TODO => 'To Do',
            self::IN_PROGRESS => 'In Progress',
            self::COMPLETED => 'Completed',
            self::ON_HOLD => 'On Hold',
        };
    }

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
}
