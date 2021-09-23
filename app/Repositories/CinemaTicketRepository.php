<?php

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CinemaTicketRepository implements CinemaTicketRepositoryInterface
{
    private $model;
    private $baseModel;

    public function __construct($model) {
        $this->model = $model;
        $this->baseModel = $model;
    }

    public function all() {
        return $this->baseModel->all();
    }

    public function get() {
        return $this->model->all();
    }

    public function with($relations) {
        return $this->model->with($relations);
    }

    public function where($column, $operator = null, $value = null, $boolean = 'and') {
        return $this->model->where($column, $operator, $value, $boolean);
    }

    public function select($fields){
        return $this->model->select($fields);
    }

    public function first() {
        return $this->model->first();
    }

    public function count() {
        return $this->model->count();
    }

    public function getItem($id) {
        return $this->model->whereId($id);
    }

    public function create(Request $request){
        return $this->baseModel->create($request->only($this->baseModel->fillable));
    }

    public function update(Request $request){
        return $this->model->update($request->only($this->baseModel->fillable));
    }

    public function delete($id){
        return $this->model->delete();
    }

    public function getMovie($id) {
        $movie = Movie::whereid($id)->with('tickets')->first();

        if (!$movie) {
            abort(404);
        }

        return $movie;
    }
}
