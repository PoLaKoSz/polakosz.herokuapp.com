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
                    <p>{{ $movie->hungarian->title }}</p>
                    <p>{{ $movie->english->title }}</p>
                    <p>{{ trans('movies.star.' . $movie->rating) }}</p>
                    <p>{{ substr($movie->date, 0, 10) }}</p>
                    <p>{{ $movie->hungarian->comment }}</p>
                    <p>{{ $movie->english->comment }}</p>

                    <div class="col-xs-12">
                        <div class="col-xs-4"></div>
                    </div>

                    @if (!empty( $movie->hungarian->port->id ))
                        <a href="https://port.hu/adatlap/film/tv/-/movie-{{ $movie->hungarian->port->id }}" target="_blank">
                            <img src="{{ asset('images/movies/favicon.port.ico') }}" alt="Port.hu" class="small-size-favicon">
                        </a>
                    @else
                        <img src="{{ asset('images/movies/favicon.port.png') }}" alt="Port.hu" class="small-size-favicon">
                    @endif

                    @if (!empty( $movie->hungarian->mafab->id ))
                        <a href="https://mafab.hu/movies/{{ $movie->hungarian->mafab->id }}" target="_blank">
                            <img src="{{ asset('images/movies/favicon.mafab.ico') }}" alt="Mafab.hu" class="small-size-favicon">
                        </a>
                    @else
                        <img src="{{ asset('images/movies/favicon.mafab.png') }}" alt="Mafab.hu" class="small-size-favicon">
                    @endif

                    @if (!empty( $movie->english->id ))
                        <a href="https://imdb.com/title/tt{{ $movie->english->id }}" target="_blank">
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
