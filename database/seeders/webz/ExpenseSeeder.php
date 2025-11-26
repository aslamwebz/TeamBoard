<?php

namespace Database\Seeders\webz;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Project;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = Vendor::all();
        $categories = ExpenseCategory::all();
        $projects = Project::all();
        $users = User::all();

        if ($vendors->isEmpty()) {
            $this->command->warn('No vendors found. Please run VendorSeeder first.');
            return;
        }

        if ($categories->isEmpty()) {
            $this->command->warn('No expense categories found. Please run ExpenseCategorySeeder first.');
            return;
        }

        $expenseTypes = [
            ['Travel Expenses', 'transportation', 'Travel related expenses'],
            ['Office Supplies', 'office', 'Supplies for the office'],
            ['Software Licenses', 'technology', 'Software subscription fees'],
            ['Consulting Fees', 'professional', 'Consulting services fees'],
            ['Utilities', 'utilities', 'Utility bills'],
            ['Rent', 'property', 'Office rent payment'],
            ['Marketing', 'marketing', 'Marketing and advertising expenses'],
            ['Training Costs', 'education', 'Training and development costs'],
            ['Equipment', 'equipment', 'Office equipment purchases'],
            ['Meals', 'food', 'Business meals and entertainment'],
        ];

        for ($i = 0; $i < 50; $i++) {
            $expenseType = $expenseTypes[array_rand($expenseTypes)];
            $vendor = $vendors->random();
            $category = $categories->random();
            $user = $users->isNotEmpty() ? $users->random() : null;
            $project = $projects->isNotEmpty() ? $projects->random() : null;

            Expense::factory()->create([
                'expense_category_id' => $category->id,
                'project_id' => $project ? $project->id : null,
                'vendor_id' => $vendor->id,
                'user_id' => $user ? $user->id : null,
                'title' => $expenseType[0],
                'description' => $expenseType[2],
                'amount' => fake()->randomFloat(2, 50, 2000),
                'expense_date' => fake()->dateTimeBetween('-6 months', 'now'),
                'status' => fake()->randomElement(['pending', 'approved', 'rejected', 'paid', 'cancelled']),
                'payment_method' => fake()->optional()->randomElement(['cash', 'credit_card', 'debit_card', 'bank_transfer', 'check', 'paypal', 'other']),
                'notes' => fake()->sentence(),
            ]);
        }
    }
}
