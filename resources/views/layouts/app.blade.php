<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="font-sans antialiased">
    <x-header></x-header>
    <main>
        {{ $slot }}
    </main>
</body>
</html>
