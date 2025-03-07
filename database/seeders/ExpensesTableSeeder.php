<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;

class ExpensesTableSeeder extends Seeder
{
    public function run()
    {
        Expense::create([
            'itemname' => 'Cement',
            'date' => now(),
            'location' => 'Downtown Site',
            'userid' => 1, // Admin user
            'amount' => 00,
        ]);

        Expense::create([
            'itemname' => 'Tools',
            'date' => now(),
            'location' => 'Uptown Site',
            'userid' => 2, // Normal user
            'amount' => 00,
        ]);
    }
}