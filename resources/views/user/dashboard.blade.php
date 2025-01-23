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
                        <h1>ENROLL NOW</h1>
                        <p>Join our community and start your journey today!</p>
                        <a href="" class="btn-main">Get Started</a>
                    </div>
                </div>
            </div>
            <!-- Add more carousel items here if needed -->
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

    <section class="enrollment-info">
        <div class="container">
            <h2>Why Enroll with Us?</h2>
            <p>We offer a variety of courses and programs to help you achieve your goals. Our experienced instructors and comprehensive curriculum ensure that you get the best education possible.</p>
            <a href="" class="btn-main">Explore Courses</a>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <h2>What Our Students Say</h2>
            <div class="testimonial-item">
                <p>"This program changed my life! The instructors are amazing and the curriculum is top-notch."</p>
                <p>- Jane Doe</p>
            </div>
            <div class="testimonial-item">
                <p>"I learned so much and made great connections. Highly recommend to anyone looking to further their education."</p>
                <p>- John Smith</p>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 Enrollment. All rights reserved.</p>
            <a href="}" class="footer-link">Contact Us</a>
        </div>
    </footer>
@endsection
