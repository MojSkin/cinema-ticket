<?php

namespace Database\Seeders;

use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movies = [
            ['title' => 'Children od heaven', 'release_year' => 1997, 'play_time' => Carbon::create(2018, 4, 20, 22, 0), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'About Elly', 'release_year' => 2009, 'play_time' => Carbon::create(2018, 4, 20, 20, 0), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'A Separation', 'release_year' => 2011, 'play_time' => Carbon::create(2018, 4, 22, 18, 0), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'The Salesman', 'release_year' => 2016, 'play_time' => Carbon::create(2018, 4, 21, 18, 0), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'The Elephant King', 'release_year' => 2017, 'play_time' => Carbon::create(2018, 4, 21, 20, 0), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        Movie::insert($movies);
    }
}
