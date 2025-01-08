@extends('layouts.admin')
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>

@section('content')
<h1 class="mt-4">Edit Hotel</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Edit Hotel</li>
</ol>
    <div class="container">
       

        <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Hotel Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Hotel Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $hotel->name }}" required>
            </div>

            <!-- Location -->
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ $hotel->location }}">
            </div>

              <!-- Price Per Night -->
              <div class="mb-3">
                <label for="price_per_night" class="form-label">Price Per Night</label>
                <input type="number" name="price_per_night" id="price_per_night" class="form-control" step="0.01"
                    value="{{ $hotel->price_per_night }}">
            </div>

             <!-- Social Media Links -->
             <div class="mb-3">
                <label for="social_media" class="form-label">Social Media Links (JSON)</label>
                <textarea name="social_media" id="social_media" rows="3" class="form-control">{{ $hotel->social_media }}</textarea>
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
                    <option value="1" {{ $hotel->availability ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ !$hotel->availability ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="4" class="form-control">{{ $hotel->description }}</textarea>
            </div>


            <!-- Map for selecting latitude and longitude -->
            <div id="map" style="height: 400px; margin-bottom: 15px;"></div>

            <div class="row">
                <div class="col-md-6">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" name="latitude" id="latitude" class="form-control" value="{{ $hotel->latitude }}"
                        readonly>
                </div>
                <div class="col-md-6">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" name="longitude" id="longitude" class="form-control"
                        value="{{ $hotel->longitude }}" readonly>
                </div>
            </div>

            <script>
                // Initialize the map with current location
                let lat = {{ $hotel->latitude ?? 10.3157 }};
                let lng = {{ $hotel->longitude ?? 123.8854 }};
                let map = L.map('map').setView([lat, lng], 13);

                // Add OpenStreetMap tiles
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // Add a draggable marker
                let marker = L.marker([lat, lng], {
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

          
            <!-- Cover Image -->
            <div class="mb-3">
                <label for="cover" class="form-label">Cover Image</label>
                <input type="file" name="cover" id="cover" class="form-control">
                {{-- @if ($hotel->cover)
                    <img src="{{ asset('storage/' . $hotel->cover) }}" alt="Cover Image"
                        style="max-height: 200px; margin-top: 10px;">
                @endif --}}
            </div>

            <!-- Multiple Images -->
            <div class="mb-3">
                <label for="images" class="form-label">Hotel Images</label>
                <input type="file" name="images[]" id="images" class="form-control" multiple>
                {{-- @if ($hotel->images)
                    <div class="mt-3">
                        @foreach ($hotel->images as $image)
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Hotel Image"
                                style="max-height: 100px; margin-right: 10px;">
                        @endforeach
                    </div>
                @endif --}}
            </div>

           

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Hotel</button>
        </form>
    </div>
@endsection
