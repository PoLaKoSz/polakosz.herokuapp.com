@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container py-5">
        <div class="row">
            @foreach($movies as $movie)
                <div class="col-6 col-md-3 mb-3">
                    <img src="{{ $movie->cover_image }}" class="img-fluid">
                </div>

                <div class="col-6 col-md-3">
                    <p>{{ $movie->hu_title }}</p>
                    <p>{{ $movie->en_title }}</p>
                    <p>{{ trans('movies.star.' . $movie->rating) }}</p>
                    <p>{{ date_format(date_create($movie->date), trans('movies.date_php_format')) }}</p>
                    <p>{{ $movie->hu_comment }}</p>
                    <p>{{ $movie->en_comment }}</p>

                    <div class="col-12">
                        <div class="col-xs-4"></div>
                    </div>

                    @if (!empty( $movie->mafab_id ))
                        <a href="https://mafab.hu/movies/{{ $movie->mafab_id }}" target="_blank" class="text-decoration-none">
                            <img src="{{ asset('images/movies/favicon.mafab.ico') }}" alt="Mafab.hu" class="img-fluid small-size-favicon">
                        </a>
                    @else
                        <img src="{{ asset('images/movies/favicon.mafab.png') }}" alt="Mafab.hu" class="img-fluid small-size-favicon">
                    @endif

                    @if (!empty( $movie->imdb_id ))
                        <a href="https://imdb.com/title/tt{{ $movie->imdb_id }}" target="_blank" class="text-decoration-none">
                            <img src="{{ asset('images/movies/favicon.imdb.ico') }}" alt="IMDb.com" class="img-fluid small-size-favicon">
                        </a>
                    @else
                        <img src="{{ asset('images/movies/favicon.imdb.png') }}" alt="IMDb.com" class="img-fluid small-size-favicon">
                    @endif

                    @if (Auth::check())
                        <p><a href="{{ LaravelLocalization::localizeURL('movies/'. ($movie->id) .'/edit') }}" class="btn btn-orange mt-3">Edit</a></p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
