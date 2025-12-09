<?php

declare(strict_types=1);

namespace App\Providers;

use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define gates for roles and permissions
        $this->gateRolesAndPermissions();
    }

    private function gateRolesAndPermissions(): void
    {
        // Gate for viewing roles
        Gate::define('view roles', function ($user) {
            // Check if user has permission to view roles or is admin
            // Safely check if the permission exists before checking if the user has it
            try {
                if ($user->hasPermissionTo('view roles')) {
                    return true;
                }
                return (bool) $user->hasRole('admin');
            } catch (\Spatie\Permission\Exceptions\PermissionDoesNotExist) {
                // If the permission doesn't exist, only allow admin access
                return $user->hasRole('admin');
            }
        });

        // Gate for viewing permissions
        Gate::define('view permissions', function ($user) {
            // Check if user has permission to view permissions or is admin
            // Safely check if the permission exists before checking if the user has it
            try {
                if ($user->hasPermissionTo('view permissions')) {
                    return true;
                }
                return (bool) $user->hasRole('admin');
            } catch (\Spatie\Permission\Exceptions\PermissionDoesNotExist) {
                // If the permission doesn't exist, only allow admin access
                return $user->hasRole('admin');
            }
        });
    }
}
