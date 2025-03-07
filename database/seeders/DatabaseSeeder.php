<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            SitesTableSeeder::class,
            SendpaymentsTableSeeder::class,
            ExpensesTableSeeder::class,
            AttendanceTableSeeder::class,
            ReceivepaymentsTableSeeder::class,
        ]);
    }
}