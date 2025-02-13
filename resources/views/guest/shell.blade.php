<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<<<<<<< HEAD
    <title>QuickEnroll</title>
=======
<title>Tpoa</title>
>>>>>>> d8040f8 (feb 13)
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('tourism-icon.png') }}" type="image/x-icon">

    <title>{{ config('app.name') }}</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha384-ObbJ16WAMsHjZXbJGD9EVldCL6DBw5UHRN6rxBcm8e5DYT9ol/8fXcwLMaVyrkI0" crossorigin="" />

    <!-- Include Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha384-SrI3tsw6JJoRfHRlFv51uQ0mBhhgyBF2L6ql96VZTzOKlrsE/YJ94rDnUMQNfo3I" crossorigin=""></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Include Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha384-ObbJ16WAMsHjZXbJGD9EVldCL6DBw5UHRN6rxBcm8e5DYT9ol/8fXcwLMaVyrkI0" crossorigin="" />

    <!-- Include Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha384-SrI3tsw6JJoRfHRlFv51uQ0mBhhgyBF2L6ql96VZTzOKlrsE/YJ94rDnUMQNfo3I" crossorigin=""></script>


        

</head>

<body class="font-sans antialiased flex">



    @if (Auth::check() && Auth::user()->role == 'user')
        @include('user.navbar')
    @else
        @include('guest.navbar')
    @endif

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    @include('guest.footer')



</body>

</html>
