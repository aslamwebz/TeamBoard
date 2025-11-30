<?php

use App\Models\Client;

it('to array', function () {
    $client = Client::factory()->create()->refresh();

    expect(array_keys($client->toArray()))->toBe([
        'id',
        'company_name',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'vat_number',
        'logo',
        'registration_number',
        'tax_id',
        'website',
        'industry',
        'description',
        'billing_plan',
        'subscription_start_date',
        'subscription_end_date',
        'subscription_status',
        'notes',
        'billing_address',
        'shipping_address',
        'primary_contact_id',
        'custom_fields',
        'tax_vat_number',
        'created_at',
        'updated_at',
    ]);
});
