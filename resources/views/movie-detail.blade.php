@extends('layouts.app')

@section('content')
    <movie-detail-component :movie="{{ json_encode($movie) }}" :all_seats="{{ json_encode($seats) }}"></movie-detail-component>
@endsection
