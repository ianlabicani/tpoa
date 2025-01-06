@extends('guest.shell')

@section('content')
<style>
    .destination-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        transition: background-color 0.3s ease-in-out;
    }

    .destiantion-image:hover {
        background-color: #e55b4e;
        color: white;
    }

    .card-body {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }



    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }

    .card-text {
        font-size: 1rem;
        color: #555;
        line-height: 1.6;
    }

    .btn-cta {
        background-color: #ff6f61;
        color: white;
        border-radius: 20px;
        font-weight: bold;
        padding: 10px 20px;
        text-transform: uppercase;
    }

   
</style>

<section class="single-page-header">
</section>

<section class="py-5">
   

    <div class="container py-5">
        <div class="row justify-content-center">
            <!-- Culture Card -->
            <div class="col-md-8">
                <img src="{{ asset('image/farming.jpg') }}" class="destination-image" alt="Fishing">
                <div class="card-body">
                    <h5 class="card-title">Farming in Aparri</h5>
                    <p class="card-text">
                      
                    </p>
                   
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
