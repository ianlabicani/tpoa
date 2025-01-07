@extends('guest.shell')

@section('content')
    <style>
        /* General Styling */
        .event-image {
            width: 100%;
            height: 300px;
            /* Consistent height for event images */
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
            .event-image {
                height: 200px;
                /* Adjusted for smaller screens */
            }
        }
    </style>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-header">
                <h3>Explore Upcoming Events</h3>
                <p>Stay updated with the latest events happening in Aparri.</p>
            </div>

            @if ($events->count())
                <div class="row">
                    @foreach ($events as $event)
                        <div class="col-md-4 d-flex">
                            <div class="card w-100 shadow-sm d-flex flex-column">
                                @if ($event->image)
                                    <!-- Display the event image -->
                                    <a href="{{ route('events.show', $event) }}"><img src="{{ asset('storage/' . $event->image) }}" class="event-image"
                                        alt="{{ $event->name }}"></a>
                                @else
                                    <!-- Placeholder for missing image -->
                                    <img src="{{ asset('images/default-event.jpg') }}" class="event-image"
                                        alt="Default Event Image">
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $event->name }}</h5>
                                    <p class="card-text flex-grow-1">{{ Str::limit($event->description, 100) }}</p>
                                   
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center">No events found.</p>
            @endif

        </div>
    </section>
@endsection
