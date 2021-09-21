<?php

namespace App\Repositories;

interface SeatRepositoryInterface
{
    public function getAll();

    public function count();

    public function report();

}
