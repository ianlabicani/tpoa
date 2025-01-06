@extends('user.shell')



<style>
    .btn-primary {
        background-color: #f1c40f;
        color: black;
        border: none;
    }

    .btn-primary:hover {
        background-color: #d4ac0d;
        color: black;
    }

    .hero-slider {
        position: relative;
        overflow: hidden;
    }

    .slider-item {
        height: 100vh;
        background-size: cover;
        background-position: center;
        display: flex;
        align-items: center;
        color: white;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.7);
        padding: 0 50px;
    }

    .slider-content {
        max-width: 600px;
    }

    .slider-content h1 {
        font-size: 7rem;
        font-weight: bold;
        line-height: 1.2;
        margin-bottom: 20px;
    }

    .slider-content p {
        font-size: 1.2rem;
        margin-bottom: 20px;
        line-height: 1.6;
    }

    .slider-link {
        display: block;
        margin-top: 10px;
        color: #f1c40f;
        text-decoration: none;
        font-size: 1rem;
        transition: color 0.3s ease;
    }

    .slider-link:hover {
        color: #d4ac0d;
    }

    .btn-main {
        background-color: #f1c40f;
        color: black;
        padding: 10px 20px;
        border: none;
        text-decoration: none;
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }

    .btn-main:hover {
        background-color: #d4ac0d;
    }

    /* Fade transition for the slider */
    .carousel-item {
        display: none;
        opacity: 0;
        transition: opacity 1s ease;
        /* Smooth fade effect */
    }

    .carousel-item.active {
        display: block;
        opacity: 1;
    }

    .carousel-fade .carousel-item {
        transform: none;
        /* Disable slide transform */
    }
</style>


@section('content')
    <div id="heroSlider" class="carousel slide carousel-fade hero-slider" data-bs-ride="carousel" data-bs-pause="false"
        data-bs-wrap="true">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="slider-item" style="background-image: url('{{ asset('image/arko.jpg') }}');">
                    <div class="slider-content">
                        <h1>ARKO  </h1>
                        <p>
                            Two roads diverged in a yellow wood, and sorry I could not travel both and be one traveler, long
                            I stood and looked down one as far as I could to where it bent in the undergrowth.
                        </p>
                    
                        <a href="{{ route('destinations.index') }}" class="slider-link">Discover more destinations</a>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="slider-item" style="background-image: url('{{ asset('image/sunset.jpg') }}');">
                    <div class="slider-content">
                        <h1>SUNSET</h1>
                        <p>
                            Explore Aparri where the river meets the sea. Discover breathtaking views and serene
                            surroundings that leave you in awe.
                        </p>

                        <a href="{{ route('destinations.index') }}" class="slider-link">Discover more destinations</a>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="slider-item" style="background-image: url('{{ asset('image/night-pier.jpg') }}');">
                    <div class="slider-content">
                        <h1> PAG-ASA   </h1>
                        <p>
                            Explore Aparri where the river meets the sea. Discover breathtaking views and serene
                            surroundings that leave you in awe.
                        </p>

                        <a href="{{ route('destinations.index') }}" class="slider-link">Discover more destinations</a>
                    </div>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section class="overview-section py-5">
        <div class="container">
            <h2 class="text-center display-6 mb-4">Tourism of Aparri</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="lead mb-4" style="text-align: justify">
                        Aparri is known for its foods such as the "bulung-unas", or Ribbon Fish (aka Belt Fish), which are in abundance during January and early February. "Kilawin naguilas-asan" is a fillet of smaller "bulung-unas" which are leftover baits, soaked in Ilocos vinegar, seasoned with salt and pepper, finely cut onions and ginger. Ludong, a variety of Pacific salmon, is the Philippines' most expensive fish, ranging from 4,000 pesos to 5,000 per kilo. Because of its price and its distinct taste and smell, it is also nicknamed "President Fish". Caught only in the Aparri delta when, after a heavy rainfall, these fish are washed down by the fast raging water from the south, down to the mouth of the Cagayan River where it meets the Babuyan Sea. Freshwater fish by nature, the salt water contributes to their super delicious taste. Ludong is available only in the rainy months of October and early November.
    
                       
                    </p>
                    <p class="lead mb-4" style="text-align: justify">
                        Aparri's attractions also include its sandy beaches and town fiesta. May 1 to 12 of every year, the town's fiesta celebrates the patron saint San Pedro Gonzales of Thelmo with nightly festivities at the auditorium, crowning of Miss Aparri beauty pageant and the "Comparza."
                    </p>
                </div>
                <div class="col-md-6">
                    <img 
                        src="{{ asset('image/bulung-unas.jpg') }}" 
                        alt="Map showing the location of Aparri" 
                        class="img-fluid shadow" 
                        style="height: 600px;">
                    <p class="text-center text-muted mt-2">
                        <small>Source: Jerc Cariño Cinco</small>
                    </p>
                </div>
    
            </div>
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




    <script>
        let lastScrollPosition = 0;

        document.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            const currentScrollPosition = window.scrollY;

            if (currentScrollPosition > lastScrollPosition && currentScrollPosition > 50) {
                // Scrolling down, hide navbar
                navbar.classList.add('hidden');
            } else {
                // Scrolling up, show navbar
                navbar.classList.remove('hidden');
            }

            lastScrollPosition = currentScrollPosition;
        });
    </script>
@endsection
