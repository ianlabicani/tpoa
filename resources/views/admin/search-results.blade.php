@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">Search Result</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">search result</li>
    </ol>

    {{-- Destinations --}}
    @if ($destinations->isNotEmpty())
        <h2>Destinations</h2>
        <div class="row">
            @foreach ($destinations as $destination)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $destination->name }}</h5>
                            <p class="card-text">
                                <strong>Location:</strong> {{ $destination->location }}<br>
                                <strong>Contact:</strong> {{ $destination->contact }}<br>
                                <strong>Service Offers:</strong> {{ $destination->service_offer }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $destinations->links() }} {{-- Pagination links --}}
    @endif

    {{-- Videos --}}
    @if ($videos->isNotEmpty())
        <h2>Videos</h2>
        <div class="row">
            @foreach ($videos as $video)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                            <p class="card-text">{{ $video->description }}</p>
                            <a href="{{ $video->url }}" class="btn btn-primary" target="_blank">Watch Video</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $videos->links() }} {{-- Pagination links --}}
    @endif

    {{-- Events --}}
    @if ($events->isNotEmpty())
        <h2>Events</h2>
        <div class="row">
            @foreach ($events as $event)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->name }}</h5>
                            <p class="card-text">{{ $event->description }}</p>
                            <p>
                                <strong>Start:</strong> {{ $event->start_date }}<br>
                                <strong>End:</strong> {{ $event->end_date }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $events->links() }} {{-- Pagination links --}}
    @endif

    {{-- No Results Found --}}
    @if ($destinations->isEmpty() && $videos->isEmpty() && $events->isEmpty())
        <p>No results found.</p>
    @endif
@endsection
