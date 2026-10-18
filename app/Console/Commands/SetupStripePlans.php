<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupStripePlans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:setup-plans';
    protected $description = 'Create standard plans in Stripe and output their IDs';

    public function handle()
    {
        $stripeKey = config('cashier.secret');
        
        if (!$stripeKey) {
            $this->error('Stripe Secret Key not found in config/env!');
            return;
        }

        $stripe = new \Stripe\StripeClient($stripeKey);

        $plans = [
            [
                'name' => 'TeamBoard Basic',
                'amount' => 2900, // $29.00
            ],
            [
                'name' => 'TeamBoard Starter',
                'amount' => 4900, // $49.00
            ],
            [
                'name' => 'TeamBoard Pro',
                'amount' => 9900, // $99.00
            ],
            [
                'name' => 'TeamBoard Enterprise',
                'amount' => 19900, // $199.00
            ],
        ];

        $this->info('Creating plans in Stripe...');

        foreach ($plans as $plan) {
            $this->info("Creating {$plan['name']}...");
            
            try {
                // Create Product
                $product = $stripe->products->create([
                    'name' => $plan['name'],
                ]);

                // Create Price
                $price = $stripe->prices->create([
                    'product' => $product->id,
                    'unit_amount' => $plan['amount'],
                    'currency' => 'usd',
                    'recurring' => ['interval' => 'month'],
                ]);

                $this->info("Created! Product ID: {$product->id} | Price ID: {$price->id}");
                $this->line("PRICE_ID: {$price->id} ({$plan['name']})");

            } catch (\Exception $e) {
                $this->error("Error creating {$plan['name']}: " . $e->getMessage());
            }
        }
    }
}
