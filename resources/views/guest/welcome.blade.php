@extends('guest.shell')



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
                            Explore Aparri where the river meets the sea. Discover breathtaking views and serene
                            surroundings that leave you in awe.
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

    <style>
        /* Section Styling */
        .article-section {
            display: flex;
            flex-direction: column;
            gap: 30px;
            margin-top: 20px;
        }

        .article-item {
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .article-image {
            flex: 1;
            width: 600px;
            /* Fixed width for all images */
            height: 400px;
            /* Fixed height for all images */
            object-fit: cover;
            border-radius: 5px;
        }

        .article-content {
            flex: 2;
            padding: 10px;
        }

        .article-content .tag {
            display: inline-block;
            border: 1px solid #000;
            border-radius: 20px;
            padding: 5px 15px;
            margin-bottom: 10px;
            font-size: 12px;
            text-transform: uppercase;
            color: #000;
            text-align: justify
        }

        .article-content h3 {
            font-size: 24px;
            font-weight: bold;
            margin: 15px 0;
            color: #333;
        }

        .article-content p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .article-item {
                flex-direction: column;
            }

            .article-image {
                width: 100%;
                /* Full width on smaller screens */
                height: auto;
                /* Maintain aspect ratio */
            }
        }

        a {
            text-decoration: none;
        }

        p {
            text-align: justify
        }
    </style>



    <!-- Articles Section -->
    <div class="container">

        <div class="article-section">
            <div class="section-header text-center">
                <h3>Explore the Aparri Culture</h3>

            </div>
            <!-- Article Item 1 -->
            <div class="article-item">

                <img src="{{ asset('image/farming.jpg') }}" alt="Farming in Aparri" class="article-image">

                <div class="article-content">
                  
                    <h3>Farming</h3>
                    <p class="text-justify">
                        Farming is integral to Aparri's culture, showcasing traditional agricultural
                    </p>

                </div>
            </div>

            <!-- Article Item 2 -->
            <div class="article-item">

                <img src="{{ asset('image/fishing.jpg') }}" alt="Fishing in Aparri" class="article-image">

                <div class="article-content">
                   
                    <h3>Fishing</h3>
                    <p class="text-justify">
                        Fishing has been a cornerstone of Aparri's livelihood and culture. The town is known for its
                        sustainable practices and reverence for the sea.
                    </p>
                </div>
                
            </div>
            <a href="{{ route('culture') }}">See More...</a>
         
        </div>
    </div>

   

@endsection
