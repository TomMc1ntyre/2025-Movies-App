<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin' . time() . '@example.com',
            'password' => Hash::make('password'), // Use a secure password in production
            'role' => 'admin',  // Set role to 'admin'
        ]);
    }
}
