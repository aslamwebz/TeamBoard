<?php

declare(strict_types=1);

namespace Database\Seeders\webz;

use App\Models\Discussion;
use Illuminate\Database\Seeder;

final class DiscussionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Discussion::factory()->count(10)->create();
    }
}
