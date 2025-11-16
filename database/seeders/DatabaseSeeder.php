<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        // if (DB::table('users')->exists()) {
        //     DB::statement('DROP DATABASE tenantwebz');
        // }

        $tenant = \App\Models\Tenant::create(['id' => 'webz']);
        $tenant->domains()->create(['domain' => 'webz']);

        $tenant->run(function () {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'user@user.com',
                'password' => Hash::make('password'),
            ]);

            $this->call([
                ClientSeeder::class,
                ProjectSeeder::class,
                InvoiceSeeder::class,
                ReportSeeder::class,
            ]);
        });
    }
}
