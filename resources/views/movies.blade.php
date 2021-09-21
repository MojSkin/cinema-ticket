@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mb-5">
                <h3>Movies in theaters</h3>
            </div>
            @foreach($movies as $movie)
                <div class="col-12 col-md-6 col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-header">{{ $movie->title }}</div>
                        <div class="card-body">
                            <table class="table table-borderless table-light">
                                <tr>
                                    <td>Production Year:</td>
                                    <td>{{ $movie->release_year }}</td>
                                </tr>
                                <tr>
                                    <td>Screen Date</td>
                                    <td>{{ \Carbon\Carbon::parse($movie->play_time)->format('Y/m/d') }}</td>
                                </tr>
                                <tr>
                                    <td>Screen Time</td>
                                    <td>{{ \Carbon\Carbon::parse($movie->play_time)->format('H:i') }}</td>
                                </tr>
                            </table>
                            <div class="d-flex">
                                @if($seats-count($movie->tickets) === 0)
                                    <button class="btn btn-dark btn-sm ml-auto" disabled="disabled">No seats available</button>
                                @else
                                    <a href="{{ route('movie-detail', $movie->id) }}" class="btn btn-primary btn-sm ml-auto">{{ $seats-count($movie->tickets) }} out of {{ $seats }} seats available </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
