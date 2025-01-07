{{-- @extends('user.shell')

@section('content')
    <style>
        /* General Styling */
        .destination-image {
            width: 100%;
            height: 260px;
            object-fit: cover;

        }

        /* Section Header Styling */
        .section-header {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Card Design */
        .card {
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-body {
            flex-grow: 1;
            /* Ensures cards have equal height */
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 15px;
        }

        .card-text {
            font-size: 1rem;
            color: #666;
        }

        /* Button Styling for Cards */
       

        .btn-show-more:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Section Margins and Padding */
        section {
            padding: 60px 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-img-top {
                height: 150px;
            }
        }
    </style>

    <section class="py-5 bg-light">
    
            <div >
                <h3>Explore the Products of Aparri.</h3>
                <p></p>
            </div>
            <div class="row">
                <!-- Alamang Card -->
                <div class="col-md-4 d-flex">
                    <div class="card w-100">
                        <img src="{{ asset('image/aramang.jpg') }}" class="card-img-top" alt="Farming">
                        <div class="card-body">
                            <h5 class="card-title">Alamang</h5>
                            <p class="card-text">The rich and fertile soil of Aparri produces varieties of crops like rice,
                                corn, vegetables, and fruits.</p>
                            <a href="{{ route('user.alamang') }}" class="btn-show-more">Show More</a>
                        </div>
                    </div>
                </div>

                <!-- Daing Card -->
                <div class="col-md-4 d-flex">
                    <div class="card w-100">
                        <img src="{{ asset('image/daing.jpg') }}" class="card-img-top" alt="Fishing">
                        <div class="card-body">
                            <h5 class="card-title">Daing</h5>
                            <p class="card-text">Fishing and fish processing are vital industries benefiting people along
                                the river and sea.</p>
                            <a href="{{ route('user.daing') }}" class="btn-show -more">Show More</a>
                        </div>
                    </div>
                </div>

                <!-- Nipa Wine Card -->
                <div class="col-md-4 d-flex">
                    <div class="card w-100">
                        <img src="{{ asset('image/nipa wine.jpg') }}" class="card-img-top" alt="Nipa Wine">
                        <div class="card-body">
                            <h5 class="card-title">Nipa Wine</h5>
                            <p class="card-text">Nipa shingle and wine-making are viable sources of income for many in the
                                Western barangays.</p>
                            <a href="{{ route('user.nipa_wine') }}" class="btn-show-more">Show More</a>
                        </div>
                    </div>
                </div>
            </div>
        
    </section>
@endsection --}}
