@extends('layouts.app')

@section('content')
    @include('inc.navbar')

    <div class="container">
        <p class="alert alert-danger">{{ trans('http_statuscodes.403') }}</p>
    </div>
@endsection
