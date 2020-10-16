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
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ mix('css/mdb.css') }}" rel="stylesheet">

</head>
<body data-spy="scroll" data-target="#navbar">
    <div id="app">
        @yield('content')

        @include('inc.contact')

        @include('inc.notifications')
    </div>

    <script type="text/javascript" src="{!! mix('js/manifest.js') !!}"></script>
    <script type="text/javascript" src="{!! mix('js/vendor.js') !!}"></script>
    <script type="text/javascript" src="{!! mix('js/app.js') !!}"></script

    <div id="fb-root"></div>

    <script>
        @if (count($errors) > 0 ||
            session('success') ||
            session('error'))
            $('#modalNotification').modal('show');
        @endif
    </script>
</body>
</html>
