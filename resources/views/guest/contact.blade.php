@extends('guest.shell')

@section('content')



<!-- Contact Info Section -->
<section class="contact-info py-5 bg-light">
    <div class="container">
        <h2 class="text-center display-5 mb-4">Get in Touch</h2>
        <div class="row text-center">
            <!-- Address -->
            <div class="col-md-4">
                <div class="contact-info-item">
                    <i class="fas fa-map-marker-alt fa-3x mb-3"></i>
                    <h4>Our Address</h4>
                    <p>Centro 1, Aparri, Cagayan, Philippines, 3515</p>
                </div>
            </div>
            <!-- Phone -->
            <div class="col-md-4">
                <div class="contact-info-item">
                    <i class="fas fa-phone fa-3x mb-3"></i>
                    <h4>Call Us</h4>
                    <p>0945 637 4167</p>
                </div>
            </div>
            <!-- Email -->
            <div class="col-md-4">
                <div class="contact-info-item">
                    <i class="fas fa-envelope fa-3x mb-3"></i>
                    <h4>Email Us</h4>
                    <p>contact@tpoa.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form py-5">
    <div class="container">
        <h2 class="text-center display-5 mb-4">Send Us a Message</h2>
        <form action="" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
            </div>
            <div class="form-group my-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
            </div>
        </form>
    </div>
</section>

<!-- Map Section -->
<section class="map-section py-5">
    <div class="container">
        <h2 class="text-center display-5 mb-4">Find Us Here</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Embed Google Map -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.970675220994!2d-122.40529668468194!3d37.78518047975721!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808f7e4f72a1a1d1%3A0x9f0324c5f92e9339!2sTravel%20Avenue!5e0!3m2!1sen!2sus!4v1620299187300!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta-section py-5 text-white" style="background-color: #28a745;">
    <div class="container text-center">
        <h2 class="display-5">Let's Get Started</h2>
        <p class="lead">Have questions? We're just a message away.</p>
        <a href="#contact-form" class="btn btn-light btn-lg">Contact Us Now</a>
    </div>
</section>

@endsection
