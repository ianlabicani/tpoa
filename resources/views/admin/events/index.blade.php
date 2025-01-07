@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">Events</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Events</li>
    </ol>

    
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>All Events</h3>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm">Create New Event</a>
        </div>
        <div class="card-body">
            @if ($events->count())
                <div class="row">
                    @foreach ($events as $event)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if ($event->image)
                                    <!-- Display Event Image -->
                                    <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top"
                                        alt="{{ $event->name }}" style="height: 200px; object-fit: cover;">
                                @else
                                    <!-- Placeholder for Missing Image -->
                                    <img src="{{ asset('images/default-event.jpg') }}" class="card-img-top"
                                        alt="Default Event Image" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $event->name }}</h5>

                                </div>
                                <div class="card-footer text-center  d-flex justify-content-between">
                                    <a href="{{ route('admin.events.show', $event->id) }}"
                                        class="btn btn-info btn-sm">View</a>
                                   


                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $events->links('pagination::bootstrap-4') }}

                </div>
            @else
                <p class="text-muted">No events found.</p>
            @endif
        </div>
    
@endsection
