@extends('layouts.app')

@section('content')
    <section id="movies" class="container">
        <div class="row section-margin">
            <div class="row  section-margin">
                <p class="italic-text text-center">Rövid szöveg jön majd ide: Ne vegyétek az értékeléseimet szentirásnak ... tudod melyik szöveg ;)</p>
            </div>

            <div class="row">
                @foreach ($movies as $movie)
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="row">
                            <div class="view overlay hm-black-strong">
                                <img src="{{asset('images/imagenotfound.svg')}}" alt="All projects">
                                <div class="mask flex-center">
                                    <div>
                                        <p class="white-text">Doomsday</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row text-center">
                            <h4><a href="#">{{ $movie->filmcim }}</a></h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection