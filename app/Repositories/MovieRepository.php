<?php

namespace App\Repositories;

use App\Models\Movie;

class MovieRepository implements MovieRepositoryInterface
{
    public function getAll() {
        return Movie::with('tickets')->get();
    }

    public function getMovie($id) {
        $movie = Movie::whereid($id)->with('tickets')->first();

        if (!$movie) {
            abort(404);
        }

        return $movie;
    }
}
