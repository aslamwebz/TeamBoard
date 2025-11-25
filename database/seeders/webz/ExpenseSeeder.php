<?php

namespace Database\Seeders\webz;

use App\Models\Expense;
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

        if ($vendors->isEmpty()) {
            $this->command->warn('No vendors found. Please run VendorSeeder first.');
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

            Expense::factory()->create([
                'vendor_id' => $vendor->id,
                'name' => $expenseType[0],
                'category' => $expenseType[1],
                'description' => $expenseType[2],
                'amount' => fake()->randomFloat(2, 50, 2000),
                'expense_date' => fake()->dateTimeBetween('-6 months', 'now'),
                'expense_type' => fake()->randomElement(['travel', 'office', 'software', 'consulting', 'utilities', 'rent', 'marketing', 'training', 'equipment', 'meals']),
                'status' => fake()->randomElement(['draft', 'pending_approval', 'approved', 'paid', 'rejected']),
                'receipt_url' => fake()->url(),
                'notes' => fake()->sentence(),
            ]);
        }
    }
}
