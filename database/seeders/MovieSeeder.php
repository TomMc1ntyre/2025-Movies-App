<?php

namespace Database\Seeders;

use App\Models\Movie;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder{
    public function run() : void{
        $currentTimestamp = Carbon::now();
        Movie::insert ([
            [
                'title' => 'Inception',
                'release_year' => '2010-01-01',
                'genre' => 'Science Fiction',
                'cover' => 'inception.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'title' => 'The Dark Knight',
                'release_year' => '2008-01-01',
                'genre' => 'Action',
                'cover' => 'dark_knight.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'title' => 'Interstellar',
                'release_year' => '2014-01-01',
                'genre' => 'Science Fiction',
                'cover' => 'interstellar.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'title' => 'Pulp Fiction',
                'release_year' => '1994-01-01',
                'genre' => 'Crime',
                'cover' => 'pulp_fiction.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
            [
                'title' => 'The Shawshank Redemption',
                'release_year' => '1994-01-01',
                'genre' => 'Drama',
                'cover' => 'shawshank_redemption.jpg',
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp,
            ],
        ]);
    }
}
