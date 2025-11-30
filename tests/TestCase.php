<?php

namespace Tests;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public User $user;

    public User $admin;

    public User $unverifiedUser;

    public Tenant $tenant;

    protected function setUp(): void
    {
        parent::setup();
        $this->withoutVite();

        \DB::statement('DROP DATABASE IF EXISTS tenantwebz_testing');

        $this->initializeTenancy();

        config(['app.url' => 'http://test.teamboard.test:8000']);
        \URL::forceRootUrl(config('app.url'));

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $this->seed(\Database\Seeders\webz\RolePermissionSeeder::class);

        $this->user = $this->createUser();
        $this->admin = $this->createUser(isAdmin: true);
        $this->unverifiedUser = $this->CreateUnverifiedUser();
    }

    private function createUser(bool $isAdmin = false): User
    {
        $user = User::factory()->create();

        if ($isAdmin) {
            $user->assignRole('admin');
        }

        return $user;
    }

    private function CreateUnverifiedUser(): User
    {
        return User::factory()->unverified()->create();
    }

    public function initializeTenancy()
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
}
