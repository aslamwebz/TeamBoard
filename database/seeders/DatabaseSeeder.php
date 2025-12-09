<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tenant;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \DB::statement('DROP DATABASE IF EXISTS tenantwebz');

        $tenant = Tenant::create(['id' => 'webz']);
        $tenant->domains()->create(['domain' => 'webz']);

        $tenant->run(function (): void {
            $this->call([
                WebzSeeder::class,
            ]);
        });
    }
}
