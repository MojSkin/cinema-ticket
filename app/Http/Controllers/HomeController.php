<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Repositories\MovieRepository;
use App\Repositories\MovieRepositoryInterface;
use App\Repositories\SeatRepository;
use App\Repositories\TicketRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    private $movieRepository;
    private $seatRepository;
    private $ticketRepository;

    public function __construct()
    {
        $this->movieRepository = new MovieRepository();
        $this->seatRepository = new SeatRepository();
        $this->ticketRepository = new TicketRepository();
    }

    public function welcome(): RedirectResponse
    {
        return redirect()->route('movies');
    }

    public function movies(): Renderable
    {
        $movies = $this->movieRepository->getAll();
        $seats = $this->seatRepository->count();

        return view('movies', ['movies' => $movies, 'seats' => $seats]);
    }

    public function movie_detail($id): Renderable
    {
        $movie = $this->movieRepository->getMovie($id);
        $seats = $this->seatRepository->getAll();
        return view('movie-detail', ['movie' => $movie, 'seats' => $seats]);
    }

    public function book(Request $request): array
    {
        return $this->ticketRepository->create($request);
    }

    public function report()
    {
        return $this->seatRepository->report();
    }
}
