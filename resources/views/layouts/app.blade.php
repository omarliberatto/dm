<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">

        @include('layouts.partials.nav')
        <div class="container">
            <div class="row">
                <div class="col-md-@yield('col', '12') col-md-offset-@yield('offset', '0')">
                    <div class="panel panel-default">
                        <div class="panel-heading">@yield('title')</div>

                        <div class="panel-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('plugins/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/bootbox.min.js') }}"></script>
    <script src="{{ asset('js/funciones_generales.js') }}"></script>
    @stack('scripts')
</body>
</html>
