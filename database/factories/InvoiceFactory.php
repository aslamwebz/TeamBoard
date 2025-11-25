<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        $total = fake()->randomFloat(2, 500, 15000);
        $tax = $total * 0.08; // 8% tax
        $amount = $total - $tax;

        return [
            'client_id' => Client::factory(),
            'project_id' => fake()->optional(0.7)->numberBetween(1, 10), // 70% chance of having a project
            'invoice_number' => 'INV-' . str_pad(fake()->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT),
            'issue_date' => fake()->date(),
            'due_date' => fake()->date('+30 days'),
            'amount' => $amount,
            'tax' => $tax,
            'total' => $total,
            'status' => fake()->randomElement(['draft', 'sent', 'paid', 'overdue', 'cancelled']),
            'description' => fake()->optional()->sentence(),
        ];
    }
}