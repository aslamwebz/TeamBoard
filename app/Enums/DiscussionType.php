<?php

declare(strict_types=1);

namespace App\Enums;

enum DiscussionType: string
{
    case PROJECT = 'project';
    case TASK = 'task';
    case CLIENT = 'client';

    public function getColorClass(): string
    {
        return match ($this) {
            self::PROJECT => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
            self::TASK => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
            self::CLIENT => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400',
        };
    }
}
