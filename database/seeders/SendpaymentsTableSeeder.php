<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sendpayment;

class SendpaymentsTableSeeder extends Seeder
{
    public function run()
    {
        Sendpayment::create([
            'breif' => 'Payment for materials',
            'paymenttype' => 'cash',
            'transationdate' => now(),
            'amount' => 00,
            'userid' => 1, // Admin user
        ]);

        Sendpayment::create([
            'breif' => 'Worker salary',
            'paymenttype' => 'online',
            'transationdate' => now(),
            'amount' => 00,
            'userid' => 2, // Normal user
        ]);
    }
}
