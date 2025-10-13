<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder{
    public function run() : void{
        $currentTimestamp = Carbon::now();
        Movie :: insert ([
            [
                'title' => 'Inception',
                'release_year' => 2010,
                'genre' => 'Science Fiction',
                'cover' => 'covers/inception.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'title' => 'The Dark Knight',
                'release_year' => 2008,
                'genre' => 'Action',
                'cover' => 'covers/dark_knight.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'title' => 'Interstellar',
                'release_year' => 2014,
                'genre' => 'Science Fiction',
                'cover' => 'covers/interstellar.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'title' => 'Pulp Fiction',
                'release_year' => 1994,
                'genre' => 'Crime',
                'cover' => 'covers/pulp_fiction.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'title' => 'The Shawshank Redemption',
                'release_year' => 1994,
                'genre' => 'Drama',
                'cover' => 'covers/shawshank_redemption.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
        ]);
    }
}
