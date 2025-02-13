@extends('guest.shell')

@section('content')
    <style>
        /* General Styling */
        .destination-container {
            position: relative;
            width: 100%;
            height: 400px;
            /* Fixed height for all images */

        }

        .destination-image {
            width: 100%;
            height: 100%;
            /* Match container height */
            object-fit: cover;
            /* Ensure images fit the container without distortion */
            object-position: center;
            border-radius: 15px;
            /* Centers the image content */
        }

        /* Title Overlay Styling */
        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30%;
            background: rgba(46, 46, 46, 0.5);
            /* Semi-transparent background */
            display: flex;
            align-items: center;
            /* Center text vertically */
            justify-content: center;
            opacity: 1;
            /* Always visible */
        }

        .image-title {
            color: #fff;
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            padding: 10px;
            text-align: center;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
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
            flex-grow: 1;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-top: 15px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .destination-container {
                height: 200px;
                /* Adjusted for smaller screens */
            }
        }

        .search-box {
            width: fit-content;
            height: fit-content;
            position: relative;
        }

        .input-search {
            height: 50px;
            width: 50px;
            border-style: none;
            padding: 10px;
            font-size: 18px;
            letter-spacing: 2px;
            outline: none;
            border-radius: 25px;
            transition: all .5s ease-in-out;
            background-color: #22a6b3;
            padding-right: 40px;
            color: #000000;
        }

        .input-search::placeholder {
            color: rgba(0, 0, 0, 0.5);
            font-size: 18px;
            letter-spacing: 2px;
            font-weight: 100;
        }

        .btn-search {
            width: 50px;
            height: 50px;
            border-style: none;
            font-size: 20px;
            font-weight: bold;
            outline: none;
            cursor: pointer;
            border-radius: 50%;
            position: absolute;
            right: 0px;
            color: #000000;
            background-color: transparent;
            pointer-events: painted;
        }

        .btn-search:focus~.input-search {
            width: 300px;
            border-radius: 0px;
            background-color: transparent;
            border-bottom: 1px solid rgba(255, 255, 255, .5);
            transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
        }

        .input-search:focus {
            width: 300px;
            border-radius: 0px;
            background-color: transparent;
            border-bottom: 1px solid rgba(255, 255, 255, .5);
            transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
        }
    </style>

    <div class="container mt-5">
        <div class=" text-center">
            <h2 class="text-center display-6 mb-4">Explore the destinations of Aparri</h2>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('destinations.index') }}" class="mb-4">
            <div class="search-box">
                <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                <input type="text" class="input-search" name="search" placeholder="Type to Search..."
                    value="{{ request()->search }}">
            </div>
        </form>
        <!-- Page Title -->
        <div class="row">
            @if ($destinations->isEmpty())
                <div class="col-12">
                    <p class="text-center text-muted">No results found for "{{ request()->search }}". Please try a different
                        search.</p>
                </div>
            @else
                @foreach ($destinations as $destination)
                    <div class="col-md-4 mb-4 d-flex">
                        <div class="card w-100">
                            <!-- Destination Cover -->
                            @if ($destination->day_images && count(json_decode($destination->day_images, true)) > 0)
                                @php $dayImages = json_decode($destination->day_images, true); @endphp

                                <div class="destination-container">
                                    <a href="{{ route('destinations.show', $destination->id) }}" class="btn-learn-more">
                                        <img src="{{ asset('storage/' . $dayImages[0]) }}" class="destination-image"
                                            alt="{{ $destination->name }}">
                                    </a>
                                    <!-- Title Overlay -->
                                    <div class="image-overlay">
                                        <p class="image-title">{{ $destination->name }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="card-img-top bg-secondary text-white text-center py-5 rounded-top">
                                    No Image Available
                                </div>
                            @endif

                            <!-- Destination Details -->
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $destinations->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
