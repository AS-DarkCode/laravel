<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;

class AttendanceTableSeeder extends Seeder
{
    public function run()
    {
        Attendance::create([
            'userid' => 2, 
            'siteid' => 1, 
            'date' => now(),
            'status' => 1, 
        ]);

        Attendance::create([
            'userid' => 2, 
            'siteid' => 2, 
            'date' => now()->subDay(),
            'status' => 0.5, 
        ]);
    }
}