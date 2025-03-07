<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'contact' => '1234567890',
            'address' => 'Admin Address',
            'joiningdate' => now(),
            'setamount' => 00,
            'profile_pic' => 'admin.jpg',
            'role' => 'admin',
        ]);

        // Normal user
        User::create([
            'name' => 'Normal User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'contact' => '0987654321',
            'address' => 'User Address',
            'joiningdate' => now(),
            'setamount' => 00,
            'profile_pic' => 'user.jpg',
            'role' => 'user',
        ]);
    }
}