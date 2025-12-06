<?php

declare(strict_types=1);

namespace App\Enums;

enum PhaseStatus: string
{
    case NOT_STARTED = 'not_started';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case ON_HOLD = 'on_hold';

    public function getColorClass(): string
    {
        return match ($this) {
            self::NOT_STARTED => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-700 dark:text-zinc-300',
            self::IN_PROGRESS => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
            self::COMPLETED => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
            self::ON_HOLD => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
        };
    }

    public function getDarkColorClass(): string
    {
        return match ($this) {
            self::NOT_STARTED => 'bg-gray-500/10 text-gray-700 dark:text-gray-400',
            self::IN_PROGRESS => 'bg-blue-500/10 text-blue-700 dark:text-blue-400',
            self::COMPLETED => 'bg-green-500/10 text-green-700 dark:text-green-400',
            self::ON_HOLD => 'bg-red-500/10 text-red-700 dark:text-red-400',
        };
    }
}