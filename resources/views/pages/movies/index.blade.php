@extends('layouts.app')

@section('content')
    @include('inc.navbar');

    <div class="container">
        @foreach($movies as $movie)
            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <img src="{{ $movie->cover_image }}">
                </div>

                <div class="col-xs-12 col-md-8">
                    <p>{{ $movie->hu_title }}</p>
                    <p>{{ $movie->en_title }}</p>
                    <p>{{ trans('movies.star.' . $movie->rating) }}</p>
                    <p>{{ substr($movie->date, 0, 10) }}</p>
                    <p>{{ $movie->hu_comment }}</p>
                    <p>{{ $movie->en_comment }}</p>

                    <div class="col-xs-12">
                        <div class="col-xs-4"></div>
                    </div>


                    @if (!empty( $movie->mafab_id ))
                        <a href="https://mafab.hu/movies/{{ $movie->mafab_id }}" target="_blank">
                            <img src="{{ asset('images/movies/favicon.mafab.ico') }}" alt="Mafab.hu" class="small-size-favicon">
                        </a>
                    @else
                        <img src="{{ asset('images/movies/favicon.mafab.png') }}" alt="Mafab.hu" class="small-size-favicon">
                    @endif

                    @if (!empty( $movie->imdb_id ))
                        <a href="https://imdb.com/title/tt{{ $movie->imdb_id }}" target="_blank">
                            <img src="{{ asset('images/movies/favicon.imdb.ico') }}" alt="IMDb.com" class="small-size-favicon">
                        </a>
                    @else
                        <img src="{{ asset('images/movies/favicon.imdb.png') }}" alt="IMDb.com" class="small-size-favicon">
                    @endif
                    
                    @if (Auth::check())
                        <p><a href="{{ LaravelLocalization::localizeURL('movies/'. ($movie->id) .'/edit') }}" class="btn btn-warning">Edit</a></p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
