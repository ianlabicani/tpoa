@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">Search Results</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Search Results</li>
    </ol>

    @if ($query)
        <p class="text-muted">Showing results for: <strong>{{ $query }}</strong></p>
    @endif

    <!-- Destinations Section -->
    <h2 class="mt-4">Destinations</h2>
    @if ($destinations->isEmpty())
        <p class="text-muted">No destinations found.</p>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($destinations as $destination)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @if ($destination->day_images && count(json_decode($destination->day_images, true)) > 0)
                            @php $dayImages = json_decode($destination->day_images, true); @endphp
                            <img src="{{ asset('storage/' . $dayImages[0]) }}" class="card-img-top" alt="{{ $destination->name }}" style="object-fit: cover; height: 200px;">
                        @else
                            <div class="bg-secondary text-white text-center py-5">No Image Available</div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $destination->name }}</h5>
                            <a href="{{ route('admin.destinations.show', $destination->id) }}" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Hotels Section -->
    <h2 class="mt-4">Hotels</h2>
    @if ($hotels->isEmpty())
        <p class="text-muted">No hotels found.</p>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($hotels as $hotel)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @if ($hotel->cover)
                            <img src="{{ asset('storage/' . $hotel->cover) }}" class="card-img-top" alt="{{ $hotel->name }}" style="object-fit: cover; height: 200px;">
                        @else
                            <div class="bg-secondary text-white text-center py-5">No Image</div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $hotel->name }}</h5>
                            <p class="card-text text-muted"><strong>Location:</strong> {{ $hotel->location }}</p>
                            <a href="{{ route('admin.hotels.show', $hotel->id) }}" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Videos Section -->
    <h2 class="mt-4">Videos</h2>
    @if ($videos->isEmpty())
        <p class="text-muted">No videos found.</p>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($videos as $video)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @if (strpos($video->url, 'youtube.com') !== false || strpos($video->url, 'youtu.be') !== false)
                            @php
                                if (strpos($video->url, 'youtu.be') !== false) {
                                    $videoId = basename($video->url);
                                } elseif (strpos($video->url, 'youtube.com') !== false) {
                                    parse_str(parse_url($video->url, PHP_URL_QUERY), $params);
                                    $videoId = $params['v'];
                                }
                                $thumbnailUrl = "https://img.youtube.com/vi/$videoId/0.jpg";
                            @endphp
                            <img src="{{ $thumbnailUrl }}" class="card-img-top" alt="{{ $video->title }}" style="object-fit: cover; height: 200px;">
                        @else
                            <div class="bg-secondary text-white text-center py-5">No Thumbnail</div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                            <a href="{{ $video->url }}" target="_blank" class="btn btn-primary btn-sm">Watch Video</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $destinations->links() }}
        {{ $hotels->links() }}
        {{ $videos->links() }}
    </div>
@endsection
