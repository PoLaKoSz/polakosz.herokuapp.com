@extends('layouts.app')

@section('content')
    <section id="movies" class="container">
        <div class="row section-padding">
            <div class="row  section-padding">
                <p class="italic-text text-center">Rövid szöveg jön majd ide: Ne vegyétek az értékeléseimet szentirásnak ... tudod melyik szöveg ;)</p>
            </div>

            <div class="row">
                @include('inc.movies')
            </div>
        </div>
    </section>
@endsection