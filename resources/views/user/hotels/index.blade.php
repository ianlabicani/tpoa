@extends('user.shell')

@section('content')
    <style>
        /* General Styling */
        .hotel-container {
            position: relative;
            width: 100%;
            height: 400px;
            /* Fixed height for all images */
        }

        .hotel-image {
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
            background: rgba(63, 63, 63, 0.5); /* Semi-transparent background */
            display: flex;
            align-items: flex-end; /* Align text at the bottom */
            justify-content: center;   
        }

        .hotel-container:hover .image-overlay {
            opacity: 1; /* Show overlay on hover */
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .hotel-container {
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
            <h2 class="text-center display-6 mb-4">View hotels of Aparri</h2>
        </div>
        <!-- Search Bar -->
        <form method="GET" action="{{ route('user.hotels.index') }}" class="mb-4">
            <div class="search-box">
                <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                <input type="text" class="input-search" name="search" placeholder="Type to Search..."
                    value="{{ request()->search }}">
            </div>
        </form>
        <div class="row g-3"> <!-- Added g-3 for spacing -->
            @if($hotels->isEmpty())
            <div class="col-12">
                <p class="text-center text-muted">No results found for "{{ request()->search }}". Please try a different search.</p>
            </div>
        @else
            @foreach ($hotels as $hotel)
                <div class="col-md-4 d-flex">
                    <div class="card w-100 shadow-sm d-flex flex-column">
                        <!-- Hotel Cover -->
                        @if ($hotel->cover)
                            <div class="hotel-container">
                                <a href="{{ route('user.hotels.show', $hotel->id) }}">
                                    <img src="{{ asset('storage/' . $hotel->cover) }}" class="hotel-image"
                                        alt="{{ $hotel->name }}">
                                </a>
                                <!-- Title Overlay -->
                                <div class="image-overlay">
                                    <p class="image-title">{{ $hotel->name }}</p>
                                </div>
                            </div>
                        @else
                            <div class="card-img-top bg-secondary text-white text-center py-5 rounded-top">
                                No Image Available
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $hotels->links() }}
        </div>
    </div>
@endsection
