<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Seat;
use App\Models\Ticket;
use App\Repositories\CinemaTicketRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $movieRepository;
    private $seatRepository;
    private $ticketRepository;

    public function __construct()
    {
//        $this->movieRepository = new MovieRepository();
//        $this->seatRepository = new SeatRepository();
//        $this->ticketRepository = new TicketRepository();

        $this->movieRepository = new CinemaTicketRepository(new Movie);
        $this->seatRepository = new CinemaTicketRepository(new Seat);
        $this->ticketRepository = new CinemaTicketRepository(new Ticket);
    }

    public function welcome(): RedirectResponse
    {
        return redirect()->route('movies');
    }

    public function movies(): Renderable
    {
        $movies = $this->movieRepository->all();
        $seats = $this->seatRepository->count();

        return view('movies', ['movies' => $movies, 'seats' => $seats]);
    }

    public function movie_detail($id): Renderable
    {
        $movie = $this->movieRepository->getItem($id)->with('tickets')->first();

        if (!$movie) {
            abort(404);
        }

        $seats = $this->seatRepository->all();
        return view('movie-detail', ['movie' => $movie, 'seats' => $seats]);
    }

    public function book(Request $request): array
    {
        $request->validate([
            'seat_id' => 'required|exists:seats,id',
            'movie_id' => 'required|exists:movies,id',
        ]);
        $request->merge(['user_id' => Auth::id()]);
        $ticket = $this->ticketRepository->create($request);

        if ($ticket) {
            $response = [
                'status' => true,
                'message' => 'Seat has been booked successfully!',
                'result' => $this->ticketRepository->getItem($ticket->id)->first(),
            ];
        } else {
            $response = [
                'status' => false,
                'message' => 'Error while booking seat for this movie!'
            ];
        }
        return $response;
    }

    public function report()
    {
        return Seat::join('tickets', 'seats.id', '=', 'tickets.seat_id')->select('seats.number as seat_number', DB::raw('count(tickets.seat_id) as total'))->groupBy('tickets.seat_id')->get();
    }
}
