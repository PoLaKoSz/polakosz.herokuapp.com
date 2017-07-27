@extends('layouts.app')

@section('content')
    <div id="{{ trans('navbar.menu_home') }}">
        @include('inc.navbar')
        
        @include('inc.bootstrap_carousel')

        @include('inc.welcome_text')

        @include('inc.about-me')
    </div>
    
    {!! $projectsView !!}
    
    {!! $moviesView !!}
@endsection