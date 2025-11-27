<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Tenant;
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

        $tenant = Tenant::create(['id' => 'webz']);
        $tenant->domains()->create(['domain' => 'webz']);


        $tenant->run(function () {
            $this->call([
                WebzSeeder::class,
            ]);
        });
    }
}
