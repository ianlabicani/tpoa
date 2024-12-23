<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TPOA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    <!-- Topbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('/') }}">TPOA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('guest.destinations.index', ['id' => 1]) }}">Destinations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        @if (Auth::user())
                            @if (Auth::user()->role === 'admin')
                                <a class="btn btn-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            @else
                                <a class="btn btn-primary" href="{{ route('user.dashboard') }}">Dashboard</a>
                            @endif
                        @else
                            <a class="btn btn-primary" href="{{ route('register') }}">Get Started</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-3 fw-bold">Welcome to TPOA</h1>
            <p class="lead mb-4">Your one-stop solution for all your travel and booking needs.</p>
            @if (!Auth::user())
                <a class="btn btn-primary" href="{{ route('register') }}">Get Started</a>
            @endif

        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container text-center">
            <h2 class="display-4">About Us</h2>
            <p class="lead">We help you plan and book your travel with ease and convenience.</p>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="bg-light py-5">
        <div class="container text-center">
            <h2 class="display-4">Our Services</h2>
            <div class="row">
                <div class="col-md-4">
                    <h4>Destinations</h4>
                    <p>Explore a wide variety of travel destinations for every budget.</p>
                </div>
                <div class="col-md-4">
                    <h4>Booking</h4>
                    <p>Book flights, accommodations, and more, all in one place.</p>
                </div>
                <div class="col-md-4">
                    <h4>Customer Support</h4>
                    <p>Our team is here to help you with all your travel needs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5">
        <div class="container text-center">
            <h2 class="display-4">Contact Us</h2>
            <p class="lead">Have questions? Reach out to us!</p>
            <a href="mailto:contact@tpoa.com" class="btn btn-primary btn-lg">Email Us</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 TPOA. All Rights Reserved.</p>
    </footer>

</body>

</html>
