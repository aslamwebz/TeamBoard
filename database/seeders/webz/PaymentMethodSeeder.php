<?php

namespace Database\Seeders\webz;

use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            ['name' => 'Credit Card', 'type' => 'card', 'description' => 'Visa, MasterCard, American Express'],
            ['name' => 'Debit Card', 'type' => 'card', 'description' => 'Bank debit cards'],
            ['name' => 'Bank Transfer', 'type' => 'transfer', 'description' => 'Direct bank transfers'],
            ['name' => 'Check', 'type' => 'check', 'description' => 'Physical checks'],
            ['name' => 'PayPal', 'type' => 'digital_wallet', 'description' => 'PayPal digital wallet'],
            ['name' => 'Stripe', 'type' => 'digital_payment', 'description' => 'Stripe payment processor'],
            ['name' => 'Cash', 'type' => 'cash', 'description' => 'Physical cash payments'],
            ['name' => 'Wire Transfer', 'type' => 'transfer', 'description' => 'International wire transfers'],
        ];

        foreach ($methods as $method) {
            \App\Models\PaymentMethod::updateOrCreate(
                ['name' => $method['name']],
                $method
            );
        }
    }
}
