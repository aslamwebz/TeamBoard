<?php

namespace Database\Factories;

use App\Models\ExpenseAttachment;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseAttachmentFactory extends Factory
{
    protected $model = ExpenseAttachment::class;

    public function definition(): array
    {
        return [
            'expense_id' => Expense::factory(),
            'file_name' => fake()->word() . '.' . fake()->fileExtension,
            'file_path' => 'expenses/' . fake()->uuid() . '.' . fake()->fileExtension,
            'file_size' => fake()->randomNumber(6),
            'mime_type' => fake()->randomElement(['application/pdf', 'image/jpeg', 'image/png', 'image/gif']),
            'uploaded_by' => User::factory(),
            'upload_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'description' => fake()->optional()->sentence(),
        ];
    }
}