@extends('layouts.app')

@section('content')
    <div id="{{ trans('navbar.menu_home') }}">
        @include('inc.navbar')
        
        @include('inc.bootstrap_carousel')

        @include('inc.welcome_text')

        @include('inc.about-me')
    </div>

    <section id="{{ trans('navbar.menu_projects') }}" class="projects">
        <div class="section-padding">
            <div class="container">
                <?php
                    $title  = trans('projects.title');
                    $design = 'light-section-header';
                ?>
                @include('inc.section-header');

                @include('inc.projects');
            </div>
        </div>
    </section>
    
    <section id="{{ trans('navbar.menu_movies') }}" class="container section-padding">
        <div class="row">
            <?php
                $title  = trans('movies.title');
                $design = 'dark-section-header';
            ?>
            @include('inc.section-header')
        </div>
        
        @include('inc.movies')

        <div id="dynamicMovies"></div>

        <div class="row text-center">
            <button class="btn btn-orange" onClick="getMovies(this)" data-container="{{ trans('navbar.menu_movies') }}" data-nextID="6">Továbbiak</button>
        </div>
    </section>
@endsection

<script>
    function getMovies(button) {
        var lastID = parseInt( $(button).attr('data-nextID') );
        var container = $(button).attr('data-container');

        $.ajax({
            url:       'api/movies',
            type:      'GET',
            dataType:  'json',
            data: {
                id:     lastID,
                _token: '{{ csrf_token() }}'
            },
            success:function(data){
                
                $('#dynamicMovies').append(data['data']);

                $(button).attr('data-nextID', lastID + 6);
            }
        });
    }
</script>