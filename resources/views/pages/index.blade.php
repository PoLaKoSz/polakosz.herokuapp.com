@extends('layouts.app')

@section('content')
    @include('inc.bootstrap_carousel')

    @include('inc.welcome_text')

    @include('inc.about-me')
    
    {!! $projectsView !!}
    
    {!! $moviesView !!}
@endsection