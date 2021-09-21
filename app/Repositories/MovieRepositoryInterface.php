<?php

namespace App\Repositories;

use App\Models\Movie;

interface MovieRepositoryInterface
{
    public function getAll();

    public function getMovie(Movie $movie);
}
