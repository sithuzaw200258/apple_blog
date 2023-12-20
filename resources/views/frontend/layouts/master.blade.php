<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/theme.scss', 'resources/js/theme.js'])

    @yield('css')
</head>
    <body>

        @include('frontend.layouts.navbar')

        <div class="container">
            <div class="row py-3 justify-content-center">
                <div class="col-md-6">
                    @yield('content')
                </div>
                <div class="col-md-3">
                    @include('frontend.layouts.sidebar')
                </div>
            </div>
        </div>
        
        @stack('scripts')
    </body>
</html>
