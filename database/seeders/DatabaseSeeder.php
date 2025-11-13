<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

      
        Admin::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
        ]);

        $tenant = \App\Models\Tenant::create(['id' => 'test']);
        $tenant->domains()->create(['domain' => 'test.teamboard.test']);

          User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@user.com',
            'tenant_id' => $tenant->id,
        ]);

    }
}
