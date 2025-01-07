@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">Destinations</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Add Destinations</li>
    </ol>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header      d-flex justify-content-between align-items-center">
                <h3>Create New Destination</h3>
                <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.destinations.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- General Details -->
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="name" class="form-label"><strong>Name</strong></label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="form-control" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- Contact & Email -->
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="contact" class="form-label"><strong>Contact</strong></label>
                                <input type="text" id="contact" name="contact" value="{{ old('contact') }}"
                                    class="form-control">
                                @error('contact')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="email" class="form-label"><strong>Email</strong></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="form-control">
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- Location --}}
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="location" class="form-label"><strong>Location</strong></label>
                            <input type="text" id="location" name="location" value="{{ old('location') }}"
                                class="form-control">
                            @error('location')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    {{-- Entrance Fee --}}
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="entrance_fee" class="form-label"><strong>Entrance Fee</strong></label>
                            <input type="number" id="entrance_fee" name="entrance_fee" value="{{ old('entrance_fee') }}"
                                class="form-control" step="0.01">
                            @error('entrance_fee')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Events -->
                    <div class="mb-3">
                        <label for="events" class="form-label"><strong>Events</strong></label>
                        <textarea id="events" name="events" rows="5" class="form-control">{{ old('events', $destination->events ?? '') }}</textarea>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                ClassicEditor.create(document.querySelector('#events')).catch(error => console.error(error));
                            });
                        </script>
                        @error('events')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- Availability --}}
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="availability" class="form-label"><strong>Availability</strong></label>
                                <select id="availability" name="availability" class="form-select">
                                    <option value="1" {{ old('availability') == 1 ? 'selected' : '' }}>Available
                                    </option>
                                    <option value="0" {{ old('availability') == 0 ? 'selected' : '' }}>Unavailable
                                    </option>
                                </select>
                                @error('availability')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- social media --}}
                    <div class="mb-3">
                        <label for="social_media" class="form-label"><strong>List of Social Media Links</strong></label>
                        <textarea id="social_media" name="social_media" rows="5" class="form-control">{{ old('social_media') }}</textarea>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                ClassicEditor.create(document.querySelector('#social_media')).catch(error => console.error(error));
                            });
                        </script>
                    </div>


                    <!-- Service Offer -->
                    <div class="mb-3">
                        <label for="service_offer" class="form-label"><strong>Service Offer</strong></label>
                        <textarea id="service_offer" name="service_offer" rows="5" class="form-control">{{ old('service_offer') }}</textarea>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                ClassicEditor.create(document.querySelector('#service_offer')).catch(error => console.error(error));
                            });
                        </script>
                    </div>
                    <!-- How to Get There -->
                    <div class="mb-3">
                        <label for="how_to_get_there" class="form-label"><strong>How to Get There</strong></label>
                        <textarea id="how_to_get_there" name="how_to_get_there" rows="5" class="form-control">{{ old('how_to_get_there') }}</textarea>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                ClassicEditor.create(document.querySelector('#how_to_get_there')).catch(error => console.error(error));
                            });
                        </script>
                    </div>
                    <!-- Images -->
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="day_images" class="form-label"><strong>Day Images</strong></label>
                                <input type="file" name="day_images[]" class="form-control" multiple>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="night_images" class="form-label"><strong>Night Images</strong></label>
                                <input type="file" name="night_images[]" class="form-control" multiple>
                            </div>
                        </div>
                    </div>
                   <!-- Location Map -->
<div class="mb-4">
    <label for="location_name" class="form-label"><strong>Location Name</strong></label>
    <input type="text" id="location_name" name="location_name" class="form-control mb-3" 
        value="{{ old('location_name', $destination->name ?? '') }}" placeholder="Enter Location Name">

    <label for="location_map" class="form-label"><strong>Select Location</strong></label>
    <div id="map" style="height: 400px;"></div>

    <!-- Latitude and Longitude Input Fields -->
    <div class="row mt-3">
        <div class="col-md-6">
            <label for="latitude" class="form-label"><strong>Latitude</strong></label>
            <input type="text" id="latitude" name="latitude" class="form-control"
                value="{{ old('latitude', $destination->latitude ?? '') }}"
                placeholder="Enter Latitude">
        </div>
        <div class="col-md-6">
            <label for="longitude" class="form-label"><strong>Longitude</strong></label>
            <input type="text" id="longitude" name="longitude" class="form-control"
                value="{{ old('longitude', $destination->longitude ?? '') }}"
                placeholder="Enter Longitude">
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Set initial latitude, longitude, and name
            const latitude = {{ old('latitude', $destination->latitude ?? 18.3564) }};
            const longitude = {{ old('longitude', $destination->longitude ?? 121.6402) }};
            const locationName = "{{ old('location_name', $destination->name ?? 'Unnamed Location') }}";

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

            // Add a draggable marker to select the location
            const marker = L.marker([latitude, longitude], { draggable: true }).addTo(map)
                .bindPopup(`<b>${locationName}</b><br>Latitude: ${latitude}<br>Longitude: ${longitude}`)
                .openPopup();

            // Update latitude, longitude, and popup when marker is dragged
            marker.on('dragend', (event) => {
                const latLng = event.target.getLatLng();
                document.getElementById('latitude').value = latLng.lat.toFixed(6);
                document.getElementById('longitude').value = latLng.lng.toFixed(6);
                marker.bindPopup(
                    `<b>${document.getElementById('location_name').value || "Unnamed Location"}</b><br>` +
                    `Latitude: ${latLng.lat.toFixed(6)}<br>Longitude: ${latLng.lng.toFixed(6)}`
                ).openPopup();
            });

            // Update marker position and map when inputs are changed
            document.getElementById('latitude').addEventListener('input', updateMarker);
            document.getElementById('longitude').addEventListener('input', updateMarker);
            document.getElementById('location_name').addEventListener('input', updatePopup);

            function updateMarker() {
                const lat = parseFloat(document.getElementById('latitude').value) || latitude;
                const lng = parseFloat(document.getElementById('longitude').value) || longitude;
                marker.setLatLng([lat, lng]);
                map.setView([lat, lng], 13);
            }

            function updatePopup() {
                const name = document.getElementById('location_name').value || "Unnamed Location";
                const lat = parseFloat(document.getElementById('latitude').value) || latitude;
                const lng = parseFloat(document.getElementById('longitude').value) || longitude;
                marker.bindPopup(`<b>${name}</b><br>Latitude: ${lat}<br>Longitude: ${lng}`).openPopup();
            }

            // Add points of interest (POIs)
            const pointsOfInterest = [
                { lat: 18.35563019274085, lng: 121.63384768213126, name: "Aparri Beach", description: "Famous for its natural beauty." },
                { lat: 18.355379815926486, lng: 121.64200090392804, name: "St Peter Thelmo Parish", description: "Historic church in Aparri." },
                { lat: 18.362924430961094, lng: 121.62882759800767, name: "Port of Aparri ", description: "Old Port of Aparri." }
            ];

            pointsOfInterest.forEach(poi => {
                L.marker([poi.lat, poi.lng]).addTo(map)
                    .bindPopup(`<strong>${poi.name}</strong><br>${poi.description}`);
            });
        });
    </script>
</div>

                    
                    <!-- Actions -->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-success">Create Destination</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
