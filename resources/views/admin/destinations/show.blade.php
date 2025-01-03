@extends('admin.shell')

@section('content')
    <div class="container mt-4">
        <!-- Destination Card -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h3>{{ $destination->name }}</h3>
            </div>
            <div class="card-body">
                <div class="map-coontainer">
                    <div id="map" class="mb-4 rounded" style="height: 500px; width: 100%;"></div>
                </div>

                <script>
                    window.onload = function() {
                        @if ($destination->latitude && $destination->longitude)
                            var latitude = {{ $destination->latitude }};
                            var longitude = {{ $destination->longitude }};
                        @else
                            var latitude = 0;
                            var longitude = 0;
                        @endif
                        var map = L.map('map').setView([latitude, longitude], 13);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap contributors'
                        }).addTo(map);
                        L.marker([latitude, longitude]).addTo(map)
                            .bindPopup('Destination: {{ $destination->name }}')
                            .openPopup();

                    };
                </script>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Location:</strong> {{ $destination->location ?? 'N/A' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Contact:</strong> {{ $destination->contact ?? 'N/A' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Email:</strong> {{ $destination->email ?? 'N/A' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Entrance Fee:</strong>
                        {{ $destination->entrance_fee ? '₱' . number_format($destination->entrance_fee, 2) : 'Free' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Availability:</strong> {{ $destination->availability ? 'Available' : 'Unavailable' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Services Offered:</strong> {{ $destination->service_offer ?? 'None' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Events:</strong> {{ $destination->events ?? 'No events listed' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Social Media:</strong>
                        @if ($destination->social_media)
                            @foreach (json_decode($destination->social_media, true) as $platform => $link)
                                <a href="{{ $link }}" target="_blank"
                                    class="btn btn-outline-primary btn-sm me-2">{{ ucfirst($platform) }}</a>
                            @endforeach
                        @else
                            No social media links
                        @endif
                    </div>
                    <div class="col-md-12">
                        <strong>How to get there:</strong>
                        {!! $destination->how_to_get_there ?? '<p>No instructions available at the moment.</p>' !!}
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>

        <!-- Day Images -->
        <div class="my-4">
            <h4 class="mb-3">Day Images</h4>
            <div class="row g-3">
                @forelse (json_decode($destination->day_images, true) ?? [] as $dayImage)
                    <div class="col-md-3">
                        <div class="card shadow-sm h-100">
                            <a href="{{ asset('storage/' . $dayImage) }}" target="_blank">
                                <img src="{{ asset('storage/' . $dayImage) }}" alt="Day Image" class="card-img-top rounded"
                                    style="height: 180px; object-fit: cover;">
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No day images available.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Night Images -->
        <div class="my-4">
            <h4 class="mb-3">Night Images</h4>
            <div class="row g-3">
                @forelse (json_decode($destination->night_images, true) ?? [] as $nightImage)
                    <div class="col-md-3">
                        <div class="card shadow-sm h-100">
                            <a href="{{ asset('storage/' . $nightImage) }}" target="_blank">
                                <img src="{{ asset('storage/' . $nightImage) }}" alt="Night Image"
                                    class="card-img-top rounded" style="height: 180px; object-fit: cover;">
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No night images available.</p>
                    </div>
                @endforelse
            </div>
        </div>


        <!-- Related Videos -->
        <div class="my-4">
            <h4>Related Videos</h4>
            @if ($videos->isEmpty())
                <p>No videos available for this destination.</p>
            @else
                <div class="row">
                    @foreach ($videos as $video)
                        <div class="col-md-6 mb-3">
                            <div class="card {{ $video->isReviewed ? 'border-info' : 'border-warning' }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $video->title }}</h5>
                                    <p class="card-text">{{ $video->description }}</p>
                                    <a href="{{ $video->url }}" target="_blank" class="btn btn-outline-primary">Watch
                                        Video</a>
                                    @if (!$video->isReviewed)
                                        <p class="mt-2">This video is pending review.</p>
                                        <form action="{{ route('admin.videos.review', $video->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
