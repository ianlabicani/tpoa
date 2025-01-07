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
            <div class="card-header      text-center">
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
            // Get latitude, longitude, and name from server-side variables
            const latitude = {{ $destination->latitude }};
            const longitude = {{ $destination->longitude }};
            const locationName = "{{ $destination->name ?? 'Unnamed Location' }}";

            // Initialize the map
            const map = L.map('map').setView([latitude, longitude], 13);

            // Add multiple tile layers
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

            // Add OpenStreetMap as the default tile layer
            baseLayers["OpenStreetMap"].addTo(map);

            // Add layer control to switch between layers
            L.control.layers(baseLayers).addTo(map);

            // Add a marker for the location
            L.marker([latitude, longitude]).addTo(map)
                .bindPopup(`<b>${locationName}</b><br>Latitude: ${latitude}<br>Longitude: ${longitude}`)
                .openPopup();

            // Add points of interest (POIs) if applicable
            const pointsOfInterest = [
                { lat: 18.35563019274085, lng: 121.63384768213126, name: "Aparri Beach", description: "Famous for its natural beauty." },
                { lat: 18.355379815926486, lng: 121.64200090392804, name: "St Peter Thelmo Parish", description: "Historic church in Aparri." },
                { lat: 18.362924430961094, lng: 121.62882759800767, name: "Port of Aparri", description: "Old Port of Aparri." }
            ];

            pointsOfInterest.forEach(poi => {
                L.marker([poi.lat, poi.lng]).addTo(map)
                    .bindPopup(`<strong>${poi.name}</strong><br>${poi.description}`);
            });
        });
    </script>
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
