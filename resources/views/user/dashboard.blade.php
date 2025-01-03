@extends('user.shell')

@section('content')

<Style>

@font-face {
    font-family: 'barabara';
    src: url('{{ asset('fonts/BARABARA-final.otf') }}') format('truetype');
    font-style: normal;
    font-weight:thin
}

h1{
    font-family: 'barabara'
}


</Style>
<!-- Hero Section Carousel -->
<section id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-pause="false" style="height: 550px;">
    <div class="carousel-inner">
        <!-- First Slide -->
        <div class="carousel-item active" style="background-image: url('{{ asset('image/arko.jpg') }}'); background-size: cover; background-position: center; height: 550px;">
            <div class="container h-100 d-flex justify-content-start align-items-center">
                <div>
                    <h1 class="display-3 text-white">WELCOME TO TPOA</h1>
                    <p class="lead mb-4 text-white">Your one-stop solution for all your travel and booking needs.</p>
                   
                </div>
            </div>
        </div>
        <!-- Second Slide -->
        <div class="carousel-item" style="background-image: url('{{ asset('image/waves.jpg') }}'); background-size: cover; background-position: center; height: 550px;">
            <div class="container h-100 d-flex justify-content-start align-items-center">
                <div>
                    <h1 class="display-3 fw-bold text-white">HATDOG</h1>
                    <p class="lead mb-4 text-white">Your adventure begins with us.</p>
                   
                </div>
            </div>
        </div>
        <!-- Third Slide -->
        <div class="carousel-item" style="background-image: url('{{ asset('image/sunset.jpg') }}'); background-size: cover; background-position: center; height: 550px;">
            <div class="container h-100 d-flex justify-content-start align-items-center">
                <div>
                    <h1 class="display-3  text-white">ADVENTURE AWAITS</h1>
                    <p class="lead mb-4 text-white">Join us for the journey of a lifetime.</p>
                 
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</section>



    <!-- About Section -->
    <section id="about" class="py-5 bg-light">
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
                    <i class="fas fa-map-marker-alt fa-3x mb-3"></i>
                    <h4>Destinations</h4>
                    <p>Explore a wide variety of travel destinations for every budget.</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-book fa-3x mb-3"></i>
                    <h4>Booking</h4>
                    <p>Book flights, accommodations, and more, all in one place.</p>
                </div>
                <div class="col-md-4">
                    <i class="fas fa-headset fa-3x mb-3"></i>
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

    
@endsection
