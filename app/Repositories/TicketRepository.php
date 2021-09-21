<?php

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TicketRepository implements TicketRepositoryInterface
{
    public function create(Request $request)
    {
        $request->validate([
            'seat_id' => 'required|exists:seats,id',
            'movie_id' => 'required|exists:movies,id',
        ]);

        $ticket = Ticket::create([
            'seat_id' => $request->seat_id,
            'movie_id' => $request->movie_id,
            'user_id' => Auth::id()
        ]);

        if ($ticket) {
            $response = [
                'status' => true,
                'message' => 'Seat has been booked successfully!',
                'result' => $this->getTicket($ticket->id),
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Error while booking seat for this movie!'
            ];
        }
        return $response;
    }

    public function getTicket($id)
    {
        return Ticket::whereId($id)->with('seat', 'movie')->first();
    }
}
