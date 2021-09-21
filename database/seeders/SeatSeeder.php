<?php

namespace Database\Seeders;

use App\Models\Seat;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seats = [];
        for ($i = 31; $i <= 40; $i++) {
            $seats[] = ['number' => $i, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()];
        }

        Seat::insert($seats);
    }
}
