<?php

namespace App\Repositories;

use App\Models\Seat;
use Illuminate\Support\Facades\DB;

class SeatRepository implements SeatRepositoryInterface
{
    public function getAll() {
        return Seat::select('id', 'number')->get();
    }

    public function count() {
        return Seat::count();
    }

    public function report()
    {
        return Seat::join('tickets', 'seats.id', '=', 'tickets.seat_id')->select('seats.number as seat_number', DB::raw('count(tickets.seat_id) as total'))->groupBy('tickets.seat_id')->get();
    }
}
