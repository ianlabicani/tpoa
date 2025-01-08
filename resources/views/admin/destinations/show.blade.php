@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">Destinations</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"> View Destinations</li>
    </ol>
    <div class="container mt-4">
        <!-- Destination Card -->
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h3>{{ $destination->name }}</h3>
            </div>
            <!-- Location Map View -->
            <div class="mb-4 p-4">

                <div id="map" style="height: 400px;"></div>

                <!-- Display Latitude, Longitude, and Location Name -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="location_name" class="form-label"><strong>Location Name</strong></label>
                        <input type="text" id="location_name" name="location_name" class="form-control"
                            value="{{ $destination->name ?? 'Unnamed Location' }}" readonly>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="latitude" class="form-label"><strong>Latitude</strong></label>
                        <input type="text" id="latitude" name="latitude" class="form-control"
                            value="{{ $destination->latitude }}" readonly>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="longitude" class="form-label"><strong>Longitude</strong></label>
                        <input type="text" id="longitude" name="longitude" class="form-control"
                            value="{{ $destination->longitude }}" readonly>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        const latitude = {{ $destination->latitude }};
                        const longitude = {{ $destination->longitude }};
                        const locationName = "{{ $destination->name ?? 'Unnamed Location' }}";

                        const map = L.map('map').setView([latitude, longitude], 13);

                        const baseLayers = {
                            "OpenStreetMap": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; OpenStreetMap contributors'
                            }),
                            "Google Streets": L.tileLayer('https://mt1.google.com/vt/lyrs=r&x={x}&y={y}&z={z}', {
                                attribution: '© Google Maps'
                            }),
                            "Google Satellite": L.tileLayer('https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                                attribution: '© Google Maps'
                            })
                        };

                        baseLayers["OpenStreetMap"].addTo(map);

                        L.control.layers(baseLayers).addTo(map);

                        L.marker([latitude, longitude]).addTo(map)
                            .bindPopup(`<b>${locationName}</b><br>Latitude: ${latitude}<br>Longitude: ${longitude}`)
                            .openPopup();
                    });
                </script>
            </div>

            <div class="card-footer text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>

        <!-- Image Galleries -->
        <div class="my-4">
            <h4 class="mb-3">Day Images</h4>
            <div class="row">
                @forelse (json_decode($destination->day_images, true) ?? [] as $dayImage)
                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="card shadow-sm">
                            <a href="{{ asset('storage/' . $dayImage) }}" target="_blank">
                                <img src="{{ asset('storage/' . $dayImage) }}" alt="Day Image"
                                    class="card-img-top img-fluid rounded">
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No day images available.</p>
                @endforelse
            </div>
        </div>

        <div class="my-4">
            <h4 class="mb-3">Night Images</h4>
            <div class="row">
                @forelse (json_decode($destination->night_images, true) ?? [] as $nightImage)
                    <div class="col-lg-3 col-md-4 col-6 mb-4">
                        <div class="card shadow-sm">
                            <a href="{{ asset('storage/' . $nightImage) }}" target="_blank">
                                <img src="{{ asset('storage/' . $nightImage) }}" alt="Night Image"
                                    class="card-img-top img-fluid rounded">
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No night images available.</p>
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

                                    <div class="mb-3">
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
                                            <iframe width="100%" height="315" src="{{ $embedUrl }}"
                                                title="Video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                        @else
                                            <a href="{{ $video->url }}" target="_blank"
                                                class="btn btn-outline-primary">Watch Video</a>
                                        @endif
                                    </div>

                                    <p class="card-text">{{ $video->description }}</p>

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
