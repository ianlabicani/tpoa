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
                <img src="{{ asset('image/gakka.jpg') }}" class="destination-image" alt="Gakka Gathering">
                <div class="card-body">
                    <h5 class="card-title">Gakka Gathering</h5>
                    <p class="card-text">
                        Gakka is a kind of sea clam known to be found only in Aparri and neighboring sea towns. Gathering gakka sea clams along the seashore is made convenient by means of a tako, a sieve-like snare of bamboo splits made easier to hold by a long wooden handle. It is cooked by pouring hot water and a little bit of salt but some know of a few who eat them raw. The technique for eating gakka like the way the old people do was pretty hard to master. They pop a single shellfish in their mouth and after a few mouth motions, the shell is magically spit out.
                    </p>
                   
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
