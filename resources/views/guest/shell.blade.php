<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('tourism-icon.png') }}" type="image/x-icon">

    <title>{{ config('app.name') }}</title>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased flex">

    @include('guest.navbar')

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>
</body>

</html>
