<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Actor;

class ActorSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Leonardo DiCaprio',
            'Scarlett Johansson',
            'Tom Hanks',
            'Jennifer Lawrence',
            'Brad Pitt',
            'Angelina Jolie',
            'Robert Downey Jr.',
            'Chris Evans',
            'Emma Stone',
            'Johnny Depp',
            'Morgan Freeman',
            'Natalie Portman',
            'Keanu Reeves',
            'Anne Hathaway',
            'Samuel L. Jackson'
        ];

        foreach ($names as $name) {
            Actor::create(['name' => $name]);
        }
    }
}
