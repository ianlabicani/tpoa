    
@extends('guest.shell')

@section('content')
    <h1>All Events</h1>

    @if ($events->count())
        <div class="list-group">
            @foreach ($events as $event)
                <div class="list-group-item">
                    <h5 class="mb-1">{{ $event->name }}</h5>
                    <p class="mb-1">{{ Str::limit($event->description, 100) }}</p>
                    <small>Start: {{ $event->start_date }} | End: {{ $event->end_date }}</small>
                    <a href="{{ route('events.show', $event) }}" class="btn btn-info btn-sm float-right ml-2">View</a>
                </div>
            @endforeach
        </div>

       
    @else
        <p>No events found.</p>
    @endif
@endsection
