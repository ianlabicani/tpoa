<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('tourism-icon.png') }}" type="image/x-icon">

    <title>QuickEnroll - Your Learning Hub</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

</head>

<body class="font-sans antialiased flex">

    <!-- Navbar -->
    @include('user.navbar')

    <!-- Main Content -->
    <main class="w-100">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('user.footer')

</body>

</html>
