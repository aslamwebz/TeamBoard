<?php

namespace Database\Seeders\webz;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create random expenses using factory
        Expense::factory()->count(50)->create();
    }
}
