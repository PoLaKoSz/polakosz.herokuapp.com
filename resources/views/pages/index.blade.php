@extends('layouts.app')

@section('content')
    <div id="{{ trans('navbar.menu_home') }}">
        @include('inc.navbar')

        <div class="budapest-img"></div>

        @include('inc.welcome_text')
    </div>

    <section id="{{ trans('navbar.menu_projects') }}" class="projects container-fluid">
        <div class="container py-5">
            <?php
                $title  = trans('projects.title');
                $design = 'light';
            ?>
            @include('inc.section-header')
            <div id="dynamicProjects" class="row text-center"></div>
        </div>
    </section>

    <section id="{{ trans('navbar.menu_movies') }}" class="container-fluid py-5">
        <div class="container">
            <?php
                $title  = trans('movies.title');
                $design = 'dark';
            ?>
            @include('inc.section-header')

            @include('inc.movies')

            <div id="dynamicMovies"></div>

            <div class="row mt-4">
                <button class="btn btn-orange mx-auto" onClick="getMovies(this)" data-container="{{ trans('navbar.menu_movies') }}" data-nextID="6">{{ trans('movies.load_more') }}</button>
            </div>
        </div>
    </section>

    <script>
        function getMovies(button) {
            button.disabled = true;
            var lastID = parseInt( $(button).attr('data-nextID') );
            var container = $(button).attr('data-container');

            $.ajax({
                url:       '<?php echo LaravelLocalization::getCurrentLocale() ?>/api/movies',
                type:      'GET',
                dataType:  'json',
                data: {
                    id:     lastID,
                    _token: '{{ csrf_token() }}'
                },
                success:function(data){
                    
                    $('#dynamicMovies').append(data['data']);

                    $(button).attr('data-nextID', lastID + 6);
                    button.disabled = false;
                }
            });
        }
    </script>
@endsection
