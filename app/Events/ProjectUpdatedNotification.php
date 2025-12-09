<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class ProjectUpdatedNotification
{
    use Dispatchable;
    use SerializesModels;
    /**
     * Create a new event instance.
     */
    public function __construct(public Project $project, public User $user)
    {
    }
}
