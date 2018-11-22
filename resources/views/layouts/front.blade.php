<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Directorio') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" id="apuslisting-theme-fonts-css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Josefin+Sans:400,600,700&amp;subset=latin%2Clatin-ext" type="text/css" media="all">
    <link rel="stylesheet" id="apuslisting-theme-fonts-css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Josefin+Sans:400,600,700&amp;subset=latin%2Clatin-ext" type="text/css" media="all">
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">

</head>
<body>
    <div id="app">

        @include('layouts.partials.navfront')
        <div class="container">
            <div class="row">
                <div class="col-md-@yield('col', '12') col-md-offset-@yield('offset', '0')">
                    <div class="panel panel-default">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('plugins/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/mark/jquery.mark.js') }}"></script>
    <script src="{{ asset('plugins/mark/datatables.mark.js') }}"></script>
    <script src="{{ asset('js/funciones_front.js') }}"></script>
    @stack('scripts')
</body>
</html>
