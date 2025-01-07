@extends('user.shell')

@section('content')
    <style>
        /* General Styling */
        .destination-image {
            width: 100%;
            height: 300px; /* Increased height for larger image */
            object-fit: cover;
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

        .card-body {
            flex-grow: 1; /* Ensures cards have equal height */
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 15px;
        }

        /* Button Styling for Cards */
        .btn-learn-more {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .btn-learn-more:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Section Margins and Padding */
        section {
            padding: 60px 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .destination-image {
                height: 200px; /* Adjusted for smaller screens */
            }
        }
    </style>

    <div class="container mt-5">
        <!-- Page Title -->
        <div class="row">
            @foreach ($destinations as $destination)
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card w-100">
                        <!-- Destination Cover -->
                        @if ($destination->day_images && count(json_decode($destination->day_images, true)) > 0)
                            @php $dayImages = json_decode($destination->day_images, true); @endphp
                            
                                <a href="{{ route('user.destinations.show', $destination->id) }}"
                                    class="btn-learn-more">
                                    <img src="{{ asset('storage/' . $dayImages[0]) }}" class="destination-image"
                                    alt="{{ $destination->name }}">
                                </a>
                        @else
                            <div class="card-img-top bg-secondary text-white text-center py-5 rounded-top">
                                No Image Available
                            </div>
                        @endif

                        <div class="card-body text-center">
                            <!-- Destination Name -->
                            <h5 class="card-title mb-3">{{ $destination->name }}</h5>
                        </div>

                       
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $destinations->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
