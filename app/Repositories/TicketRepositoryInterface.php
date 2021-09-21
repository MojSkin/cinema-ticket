<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface TicketRepositoryInterface
{
    public function create(Request $request);
    public function getTicket($id);
}
