@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Add Hotel</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Add Hotel</li>
</ol>
    <div class="container">
        

        <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Hotel Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Hotel Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <!-- Price Per Night -->
            <div class="mb-3">
                <label for="price_per_night" class="form-label">Price Per Night</label>
                <input type="number" name="price_per_night" id="price_per_night" class="form-control" step="0.01">
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="4" class="form-control"></textarea>
            </div>

            <!-- Cover Image -->
            <div class="mb-3">
                <label for="cover" class="form-label">Cover Image</label>
                <input type="file" name="cover" id="cover" class="form-control">
            </div>
            <div class="mb-3">
                <label for="images" class="form-label">Hotel Images</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple>
            </div>


            <!-- Social Media Links -->
            <div class="mb-3">
                <label for="social_media" class="form-label">Social Media Links (JSON)</label>
                <textarea name="social_media" id="social_media" rows="3" class="form-control"
                    placeholder='{"facebook":"https://facebook.com","instagram":"https://instagram.com"}'></textarea>
            </div>

             <!-- Services Offered -->
            <div class="mb-3">
                <label for="services" class="form-label">Services Offered</label>
                <textarea name="services" id="services" rows="3" class="form-control">{{ old('services', $hotel->services ?? '') }}</textarea>
                <script>
                    document.addEventListener("DOMContentLoaded", () => {
                        ClassicEditor.create(document.querySelector('#services'))
                            .catch(error => console.error(error));
                    });
                </script>
            </div>
            

            <!-- Availability -->
            <div class="mb-3">
                <label for="availability" class="form-label">Availability</label>
                <select name="availability" id="availability" class="form-select">
                    <option value="1">Available</option>
                    <option value="0">Unavailable</option>
                </select>
            </div>

            <!-- Location -->
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location" class="form-control">
            </div>
            <!-- Map for selecting latitude and longitude -->
            <div id="map" style="height: 400px; margin-bottom: 15px;"></div>

            <div class="row">
                <div class="col-md-6">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" name="latitude" id="latitude" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" name="longitude" id="longitude" class="form-control" readonly>
                </div>
            </div>

            <script>
                // Initialize the map
                let map = L.map('map').setView([10.3157, 123.8854], 13); // Default location (e.g., Cebu City)

                // Add OpenStreetMap tiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // Add a marker with drag functionality
                let marker = L.marker([10.3157, 123.8854], {
                    draggable: true
                }).addTo(map);

                // Update latitude and longitude inputs on marker drag
                marker.on('dragend', function(e) {
                    let latLng = marker.getLatLng();
                    document.getElementById('latitude').value = latLng.lat;
                    document.getElementById('longitude').value = latLng.lng;
                });

                // Geocode address input to update marker
                document.getElementById('location').addEventListener('input', function() {
                    let address = this.value;
                    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${address}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data && data[0]) {
                                let lat = data[0].lat;
                                let lon = data[0].lon;
                                marker.setLatLng([lat, lon]);
                                map.setView([lat, lon], 13);
                                document.getElementById('latitude').value = lat;
                                document.getElementById('longitude').value = lon;
                            }
                        });
                });
            </script>


            

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Add Hotel</button>
        </form>
    </div>
@endsection
