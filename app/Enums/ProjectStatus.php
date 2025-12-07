<?php

declare(strict_types=1);

namespace App\Enums;

enum ProjectStatus: string
{
    case PLANNING = 'planning';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case ON_HOLD = 'on_hold';

    public function getColorClass(): string
    {
        return match ($this) {
            self::PLANNING => 'bg-yellow-500/10 text-yellow-700 dark:text-yellow-400',
            self::IN_PROGRESS => 'bg-sky-500/10 text-blue-700 dark:text-blue-400',
            self::COMPLETED => 'bg-green-500/10 text-green-700 dark:text-green-400',
            self::ON_HOLD => 'bg-red-500/10 text-red-700 dark:text-red-400',
        };
    }
}
