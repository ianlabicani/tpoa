@extends('Guest.shell')

@section('content')


<div class="container mt-4">
    <!-- Destination Section -->
    <div class="card shadow-sm p-4">
        <div class="row">
            <!-- Column 1: Destination Details -->
            <div class="col-md-6">
                <h3 class="mb-3">
                    <i class="fas fa-map-marker-alt me-2"></i>{{ $destination->name }}
                </h3>
                <p><strong>Location:</strong> {{ $destination->location ?? 'Not specified' }}</p>
                <p><strong>Contact:</strong> {{ $destination->contact ?? 'Not specified' }}</p>
                <p><strong>Email:</strong> {{ $destination->email ?? 'Not specified' }}</p>
                <p><strong>Entrance Fee:</strong>
                    {{ $destination->entrance_fee ? '₱' . number_format($destination->entrance_fee, 2) : 'Not specified' }}
                </p>
                <p><strong>Availability:</strong> {{ $destination->availability ? 'Available' : 'Unavailable' }}</p>
                <p><strong>How to Get There:</strong></p>
                <div>{!! $destination->how_to_get_there ?? 'No information available' !!}</div>

         <!-- Day Images -->
<div class="my-4">
    <h4 class="mb-3">Day Images</h4>
    <div class="row mt-4">
        @forelse (json_decode($destination->day_images, true) ?? [] as $dayImage)
            <div class="col-md-6 mb-3">
                <img src="{{ asset('storage/' . $dayImage) }}" alt="Day Image"
                    class="img-fluid rounded" style="object-fit: cover; height: 250px;">
            </div>
        @empty
            <p class="text-muted">No day images available.</p>
        @endforelse
    </div>
</div>

<!-- Night Images -->
<div class="my-4">
    <h4 class="mb-3">Night Images</h4>
    <div class="row mt-4">
        @forelse (json_decode($destination->night_images, true) ?? [] as $nightImage)
            <div class="col-md-6 mb-3">
                <img src="{{ asset('storage/' . $nightImage) }}" alt="Night Image"
                    class="img-fluid rounded" style="object-fit: cover; height: 250px;">
            </div>
        @empty
            <p class="text-muted">No night images available.</p>
        @endforelse
    </div>
</div>

                <!-- Feedback Section -->
                <div class="mt-4">
                    <h4>Feedbacks</h4>
                    @forelse ($feedbacks as $feedback)
                        <div class="card mb-3 p-3">
                            <p><strong>{{ $feedback->user->name ?? 'Anonymous' }}:</strong> {{ $feedback->comment }}</p>
                        </div>
                    @empty
                        <p>No feedbacks yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Column 2: Map and Related Videos -->
            <div class="col-md-6">
                <!-- Map -->
                <div id="map" style="height: 300px;" class="mb-4"></div>

                <!-- Related Videos -->
                <h4>Related Videos</h4>
                @if ($videos->isEmpty())
                    <p>No videos available for this destination.</p>
                @else
                    <div class="row">
                        @foreach ($videos as $video)
                            <div class="col-md-12 mb-3">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <!-- Video Title -->
                                        <h5 class="card-title">{{ $video->title }}</h5>
                                        <!-- Embed YouTube Video -->
                                        @if (strpos($video->url, 'youtube.com') !== false || strpos($video->url, 'youtu.be') !== false)
                                            @php
                                                if (strpos($video->url, 'youtu.be') !== false) {
                                                    $videoId = basename($video->url);
                                                    $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                                } elseif (strpos($video->url, 'youtube.com') !== false) {
                                                    parse_str(parse_url($video->url, PHP_URL_QUERY), $params);
                                                    $embedUrl = 'https://www.youtube.com/embed/' . $params['v'];
                                                }
                                            @endphp
                                            <iframe width="100%" height="200" src="{{ $embedUrl }}" frameborder="0"
                                                allowfullscreen></iframe>
                                        @else
                                            <a href="{{ $video->url }}" target="_blank" class="btn btn-outline-primary">Watch Video</a>
                                        @endif
                                        <!-- Video Description -->
                                        <p class="mt-2">{{ $video->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

   
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const latitude = {{ $destination->latitude }};
        const longitude = {{ $destination->longitude }};
        const locationName = "{{ $destination->name ?? 'Unnamed Location' }}";

        const map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.marker([latitude, longitude]).addTo(map)
            .bindPopup(`<b>${locationName}</b>`)
            .openPopup();
    });
</script>
@endsection
