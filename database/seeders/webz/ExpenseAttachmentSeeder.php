<?php

namespace Database\Seeders\webz;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class ExpenseAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenses = Expense::all();

        if ($expenses->isEmpty()) {
            $this->command->warn('No expenses found. Please run ExpenseSeeder first.');
            return;
        }

        foreach ($expenses as $expense) {
            // Create 1-2 attachments per expense
            for ($i = 0; $i < rand(1, 2); $i++) {
                $expense->attachments()->create([
                    'filename' => fake()->word() . '_' . fake()->fileExtension,
                    'original_name' => fake()->word() . '_' . fake()->fileExtension,
                    'file_path' => 'expenses/' . fake()->uuid . '.' . fake()->fileExtension,
                    'size' => fake()->randomNumber(6),
                    'mime_type' => fake()->randomElement(['image/jpeg', 'image/png', 'application/pdf', 'text/plain']),
                    'description' => fake()->sentence(),
                ]);
            }
        }
    }
}
