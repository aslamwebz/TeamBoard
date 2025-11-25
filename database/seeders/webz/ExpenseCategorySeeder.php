<?php

namespace Database\Seeders\webz;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Travel', 'description' => 'Travel related expenses', 'color' => '#3B82F6'],
            ['name' => 'Office Supplies', 'description' => 'Office equipment and supplies', 'color' => '#10B981'],
            ['name' => 'Software', 'description' => 'Software licenses and subscriptions', 'color' => '#8B5CF6'],
            ['name' => 'Consulting', 'description' => 'Consulting and professional services', 'color' => '#F59E0B'],
            ['name' => 'Utilities', 'description' => 'Utility bills and services', 'color' => '#EF4444'],
            ['name' => 'Rent', 'description' => 'Office or facility rent', 'color' => '#EC4899'],
            ['name' => 'Marketing', 'description' => 'Marketing and advertising expenses', 'color' => '#06B6D4'],
            ['name' => 'Training', 'description' => 'Training and development costs', 'color' => '#84CC16'],
            ['name' => 'Equipment', 'description' => 'Equipment purchases', 'color' => '#F97316'],
            ['name' => 'Meals', 'description' => 'Business meals and entertainment', 'color' => '#6366F1'],
        ];

        foreach ($categories as $category) {
            \App\Models\ExpenseCategory::updateOrCreate(
                ['name' => $category['name']],
                $category
            );
        }
    }
}
