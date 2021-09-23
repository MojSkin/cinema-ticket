<?php

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Http\Request;

interface CinemaTicketRepositoryInterface
{
    public function setModel($model);
    public function getModel();
    public function all();
    public function get();
    public function with($relations);
    public function where($column, $operator = null, $value = null, $boolean = 'and');
    public function first();
    public function count();
    public function getItem($id);
    public function select($fields);
    public function create(Request $request);
    public function update(Request $request);
    public function delete($id);
}
