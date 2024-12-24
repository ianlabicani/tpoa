@extends('guest.shell')


@section('content')
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
@endsection
