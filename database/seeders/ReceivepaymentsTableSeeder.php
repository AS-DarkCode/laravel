<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Receivepayment;

class ReceivepaymentsTableSeeder extends Seeder
{
    public function run()
    {
        Receivepayment::create([
            'userid' => 2, // From worker (normal user)
            'siteid' => null,
            'purpose' => 'Advance return',
            'amount' => 00,
            'date' => now(),
        ]);

        Receivepayment::create([
            'userid' => null,
            'siteid' => 1, // From contractor/site
            'purpose' => 'Site completion payment',
            'amount' => 00,
            'date' => now(),
        ]);
    }
}
