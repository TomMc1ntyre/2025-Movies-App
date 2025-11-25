<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Reset users table to avoid duplicates
        DB::table('users')->truncate();

        // Create admin user
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Call other seeders
        $this->call([
            MovieSeeder::class,
            ActorSeeder::class,
        ]);
    }
}
