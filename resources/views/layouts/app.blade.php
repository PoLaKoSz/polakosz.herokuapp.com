<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body data-spy="scroll" data-target="#navbar">
    <div id="app">
        @yield('content')

        @include('inc.contact')

        @include('inc.popup')
    </div>

    <script type="text/javascript" src="{!! asset('js/app.js') !!}"></script>

    <div id="fb-root"></div>
</body>
</html>