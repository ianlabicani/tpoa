@extends('layouts.admin')

@section('content')
<h1 class="mt-4">View Details</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">View Details</li>
</ol>
    <div class="container p-4">
        <div class="card mb-4 p-4">
            <div class="row g-0">
                <!-- Column 1: Hotel Details -->
                <div class="col-md-6 p-4">
                    <div class="card-body">
                        <!-- Hotel Name -->
                        <h1 class="card-title">
                            <i class="fas fa-hotel me-2"></i>{{ $hotel->name }}
                        </h1>

                        <!-- Location -->
                        <p class="card-text">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <strong>Location:</strong> {{ $hotel->location ?? 'Not specified' }}
                        </p>

                        <!-- Price Per Night -->
                        <p class="card-text">
                            <i class="fas fa-dollar-sign me-2"></i>
                            <strong>Price Per Night:</strong>
                            {{ $hotel->price_per_night ? '₱' . number_format($hotel->price_per_night, 2) : 'Not specified' }}
                        </p>

                        <!-- Description -->
                        <p class="card-text">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Description:</strong>
                            {{ $hotel->description ?? 'No description available' }}
                        </p>

                       <!-- Services Offered -->
<p class="card-text">
    <strong>Services Offered:</strong>
    {!! $hotel->services ?? 'No services specified' !!}
</p>


                        <!-- Availability -->
                        <p class="card-text">
                            <i class="fas fa-calendar-check me-2"></i>
                            <strong>Availability:</strong>
                            {{ $hotel->availability ? 'Available' : 'Unavailable' }}
                        </p>

                        <!-- Social Media Links -->
                        @if ($hotel->social_media)
                            <p class="card-text">
                                <strong>Follow Us:</strong>
                            </p>
                            <div>
                                @php
                                    $socialMedia = json_decode($hotel->social_media, true);
                                @endphp
                                @foreach ($socialMedia as $platform => $link)
                                    <a href="{{ $link }}" target="_blank" class="btn btn-sm btn-link">
                                        <i class="fab fa-{{ strtolower($platform) }} me-1"></i>
                                        {{ ucfirst($platform) }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Image Gallery -->
                    <div class="row mt-4">
                        @foreach ($hotel->images as $image)
                            <div class="col-md-6 mb-3">
                                <img src="{{ asset('storage/' . $image->path) }}" class="img-fluid rounded" alt="Hotel Image">
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Column 2: Map -->
                <div class="col-md-6">
                    <div id="map" style="height: 100%; min-height: 400px;"></div>
                </div>
            </div>

           
        </div>
    </div>

    <script>
        let lat = {{ $hotel->latitude }};
        let lng = {{ $hotel->longitude }};
        let map = L.map('map').setView([lat, lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        L.marker([lat, lng]).addTo(map)
            .bindPopup("{{ $hotel->name }}")
            .openPopup();
    </script>
@endsection
