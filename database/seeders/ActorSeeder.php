<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;
class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Actor::create(['name' => 'Tom Cruise']);
        Actor::create(['name' => 'Zendaya']);
        Actor::create(['name' => 'Ryan Gosling']);
    }
}
