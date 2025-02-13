@extends('guest.shell')

@section('content')
   

    <div class="card mb-4 mt-4" style="max-width: 600px; margin: auto;">
        @if ($event->image)
            <!-- Display the event image -->
            <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->name }}" style="max-height: 400px; object-fit: cover;">
        @else
            <!-- Placeholder for missing image -->
            <img src="{{ asset('images/default-event.jpg') }}" class="card-img-top" alt="Default Event Image" style="max-height: 400px; object-fit: cover;">
        @endif

        <div class="card-body">
            <h5 class="card-title text-center">{{ $event->name }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ Str::limit($event->description, 150) }}</p>
            <p class="card-text"><strong>History:</strong> {{ $event->history ?? 'No history available' }}</p>

            <p class="card-text"><strong>Start Date:</strong> {{ $event->start_date }}</p>
            <p class="card-text"><strong>End Date:</strong> {{ $event->end_date }}</p>
            <small> <p class="card-text">Image Source: {{ $event->source }}</p></small>
        </div>

    </div>
@endsection
