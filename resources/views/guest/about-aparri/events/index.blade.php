@extends('guest.shell')

@section('content')
    <style>
        /* General Styling */
        .event-image-container {
            position: relative;
            width: 100%;
            height: 300px;
            overflow: hidden;
        }

        .event-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            font-size: 1.2rem;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        .event-image-container:hover .image-overlay {
            opacity: 1;
        }

        .section-header {
            text-align: center;
            margin-bottom: 30px;
        }

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

        .large-header {
            font-size: 2rem;
        }

        section {
            padding: 60px 0;
        }

        @media (max-width: 768px) {
            .event-image-container {
                height: 200px;
            }

            .image-overlay {
                font-size: 1rem;
            }
        }
    </style>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="section-header">
                <h3 class="lead large-header">Explore Upcoming Events</h3>
                <p class="lead">Stay updated with the latest events happening in Aparri.</p>
            </div>

            @if ($events->isNotEmpty())
                @foreach ($events as $month => $monthlyEvents)
                    <!-- Display Month -->
                    <h4 class="lead mt-4 large-header">{{ $month }}</h4>

                    <div class="row">
                        @foreach ($monthlyEvents as $event)
                            <div class="col-md-4 d-flex">
                                <div class="card w-100 shadow-sm d-flex flex-column">
                                    <a href="{{ route('events.show', $event) }}" class="event-image-container">
                                        @if ($event->image)
                                            <img src="{{ asset('storage/' . $event->image) }}" class="event-image" alt="{{ $event->name }}">
                                        @else
                                            <img src="{{ asset('images/default-event.jpg') }}" class="event-image" alt="Default Event Image">
                                        @endif
                                        <div class="image-overlay">{{ $event->name }}</div>
                                    </a>
                                    <div class="card-body d-flex flex-column">
                                        <p class="card-text flex-grow-1">{{ Str::limit($event->description, 100) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <p class="text-center">No events found.</p>
            @endif
        </div>
    </section>
@endsection
