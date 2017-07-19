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

    <!-- Material Design for Bootstrap -->
    <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('inc.navbar')

        @include('inc.bootstrap_carousel')

        @include('inc.welcome_text')

        @include('inc.about-me')

        @include('inc.projects')

        @include('inc.movies')

        @include('inc.contact')
        
        @yield('content')
    </div>

    <script type="text/javascript" src="{!! asset('js/app.js') !!}"></script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</body>
</html>