<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Tenant;
use App\Models\User;
use Database\Seeders\webz\RolePermissionSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Spatie\Permission\PermissionRegistrar;

abstract class TestCase extends BaseTestCase
{
    public User $user;

    public User $admin;

    public User $unverifiedUser;

    public Tenant $tenant;

    protected function setUp(): void
    {
        parent::setup();
        \Illuminate\Database\Eloquent\Model::unguard();
        $this->withoutVite();

        DB::statement('DROP DATABASE IF EXISTS tenantwebz_testing');

        $this->initializeTenancy();

        config(['app.url' => 'http://test.teamboard.test:8000']);
        URL::forceRootUrl(config('app.url'));

        $this->app->make(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->seed(RolePermissionSeeder::class);

        $this->user = $this->createUser();
        $this->admin = $this->createUser(isAdmin: true);
        $this->unverifiedUser = $this->createUnverifiedUser();
    }

    final public function initializeTenancy()
    {
        $tenant = Tenant::create([
            'id' => 'webz_testing',
            'legal_name' => 'Webz Testing',
            'logo' => 'https://via.placeholder.com/150',
            'email' => 'test@example.com',
            'phone' => '1234567890',
        ]);
        $tenant->domains()->create(['domain' => 'test']);

        tenancy()->initialize($tenant);
    }

    private function createUser(bool $isAdmin = false): User
    {
        $user = User::factory()->create();

        if ($isAdmin) {
            $user->assignRole('admin');
        }

        return $user;
    }

    private function createUnverifiedUser(): User
    {
        return User::factory()->unverified()->create();
    }
}
