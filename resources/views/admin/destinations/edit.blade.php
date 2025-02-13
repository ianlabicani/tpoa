@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">Destinations</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Edit Destinations</li>
    </ol>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Edit Destination: {{ $destination->name }}</h3>
                <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary   btn-sm">Back to List</a>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.destinations.update', $destination->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- General Details -->
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="name" class="form-label"><strong>Name</strong></label>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', $destination->name) }}" class="form-control" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="location" class="form-label"><strong>Location</strong></label>
                                <input type="text" id="location" name="location"
                                    value="{{ old('location', $destination->location) }}" class="form-control">
                                @error('location')
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
                                <input type="text" id="contact" name="contact"
                                    value="{{ old('contact', $destination->contact) }}" class="form-control">
                                @error('contact')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="email" class="form-label"><strong>Email</strong></label>
                                <input type="email" id="email" name="email"
                                    value="{{ old('email', $destination->email) }}" class="form-control">
                                @error('email')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <!-- Entrance Fee -->
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="entrance_fee" class="form-label"><strong>Entrance Fee</strong></label>
                                <input type="number" id="entrance_fee" name="entrance_fee"
                                    value="{{ old('entrance_fee', $destination->entrance_fee) }}" class="form-control"
                                    step="0.01">
                                @error('entrance_fee')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Events --}}
                        <div class="mb-3">
                            <label for="service_offer" class="form-label"><strong>List of Events</strong></label>
                            <textarea id="events" name="events" rows="5" class="form-control">{{ old('events', $destination->events) }}</textarea>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    ClassicEditor.create(document.querySelector('#events')).catch(error => console.error(error));
                                });
                            </script>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="availability" class="form-label"><strong>Availability</strong></label>
                                <select id="availability" name="availability" class="form-select">
                                    <option value="1"
                                        {{ old('availability', $destination->availability) == 1 ? 'selected' : '' }}>
                                        Available</option>
                                    <option value="0"
                                        {{ old('availability', $destination->availability) == 0 ? 'selected' : '' }}>
                                        Unavailable</option>
                                </select>
                                @error('availability')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="mb-3">
                        <label for="social_media" class="form-label"><strong>List of Social Media Links</strong></label>
                        <textarea id="social_media" name="social_media" rows="5" class="form-control">{{ old('social_media', $destination->social_media) }}</textarea>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                ClassicEditor.create(document.querySelector('#social_media')).catch(error => console.error(error));
                            });
                        </script>
                    </div>

                    {{-- service offer --}}
                    <div class="mb-3">
                        <label for="service_offer" class="form-label"><strong>List of Services Offered</strong></label>
                        <textarea id="service_offer" name="service_offer" rows="5" class="form-control">{{ old('service_offer', $destination->service_offer) }}</textarea>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                ClassicEditor.create(document.querySelector('#service_offer')).catch(error => console.error(error));
                            });
                        </script>
                    </div>

                    <!-- How to Get There -->
                    <div class="mb-3">
                        <label for="how_to_get_there" class="form-label"><strong>How to Get There</strong></label>
                        <textarea id="how_to_get_there" name="how_to_get_there" rows="5" class="form-control">{{ old('how_to_get_there', $destination->how_to_get_there ?? '') }}</textarea>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                ClassicEditor.create(document.querySelector('#how_to_get_there')).catch(error => console.error(error));
                            });
                        </script>
                    </div>

                     <!-- Description & History -->
                     <div class="mb-3">
                        <label for="description" class="form-label"><strong>Description</strong></label>
                        <textarea id="description" name="description" rows="5" class="form-control">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
<<<<<<< HEAD
                    </div>

                    <div class="mb-3">
                        <label for="history" class="form-label"><strong>History</strong></label>
                        <textarea id="history" name="history" rows="5" class="form-control">{{ old('history') }}</textarea>
                        @error('history')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Service Offer Image -->
                    <div class="mb-3">
                        <label for="service_offer_image" class="form-label"><strong>Service Offer Image</strong></label>
                        <input type="file" name="service_offer_image[]" class="form-control" multiple>
                        @error('service_offer_image')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
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
=======
>>>>>>> d8040f8 (feb 13)
                    </div>

                    <div class="mb-3">
                        <label for="history" class="form-label"><strong>History</strong></label>
                        <textarea id="history" name="history" rows="5" class="form-control">{{ old('history') }}</textarea>
                        @error('history')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image_source" class="form-label"><strong>Image Source</strong></label>
                        <textarea id="image_source" name="image_source" rows="5" class="form-control">{{ old('image_source') }}</textarea>
                        @error('image_source')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                <!-- Service Offer Image -->
<div class="mb-3">
    <label for="service_offer_image" class="form-label"><strong>Service Offer Image</strong></label>
    <input type="file" id="service_offer_image" name="service_offer_image[]" class="form-control" multiple onchange="previewImages('service_offer_image', 'serviceOfferPreview')">
    @error('service_offer_image')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror

    <!-- Preview Section -->
    <div id="serviceOfferPreview" class="mt-3 d-flex flex-wrap gap-3">
        @php $serviceOfferImages = json_decode($destination->service_offer_image, true) ?? []; @endphp
        @foreach ($serviceOfferImages as $image)
            <div class="image-preview-container">
                <img src="{{ asset('storage/' . $image) }}" alt="Service Offer Image" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
        @endforeach
    </div>
</div>

<!-- Day Images -->
<div class="col-12">
    <div class="mb-3">
        <label for="day_images" class="form-label"><strong>Day Images</strong></label>
        <input type="file" id="day_images" name="day_images[]" class="form-control" multiple onchange="previewImages('day_images', 'dayImagesPreview')">

        <!-- Preview Section -->
        <div id="dayImagesPreview" class="mt-3 d-flex flex-wrap gap-3">
            @php $dayImages = json_decode($destination->day_images, true) ?? []; @endphp
            @foreach ($dayImages as $image)
                <div class="image-preview-container">
                    <img src="{{ asset('storage/' . $image) }}" alt="Day Image" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Night Images -->
<div class="col-12">
    <div class="mb-3">
        <label for="night_images" class="form-label"><strong>Night Images</strong></label>
        <input type="file" id="night_images" name="night_images[]" class="form-control" multiple onchange="previewImages('night_images', 'nightImagesPreview')">

        <!-- Preview Section -->
        <div id="nightImagesPreview" class="mt-3 d-flex flex-wrap gap-3">
            @php $nightImages = json_decode($destination->night_images, true) ?? []; @endphp
            @foreach ($nightImages as $image)
                <div class="image-preview-container">
                    <img src="{{ asset('storage/' . $image) }}" alt="Night Image" class="img-thumbnail" style="width: 150px; height: 150px; object-fit: cover;">
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function previewImages(inputId, previewContainerId) {
        const input = document.getElementById(inputId);
        const container = document.getElementById(previewContainerId);

        // Clear existing previews
        container.innerHTML = '';

        if (input.files) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail';
                    img.style.width = '150px';
                    img.style.height = '150px';
                    img.style.objectFit = 'cover';
                    container.appendChild(img);
                };

                reader.readAsDataURL(file);
            });
        }
    }
</script>


                   <!-- Location Map Edit -->
<div class="mb-4">
    <label for="location_map" class="form-label"><strong>Edit Location</strong></label>
    <div id="edit-map" style="height: 400px;"></div>

    <!-- Latitude and Longitude Inputs -->
    <div class="row mt-3">
        <div class="col-md-6">
            <label for="latitude" class="form-label"><strong>Latitude</strong></label>
            <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $destination->latitude ?? 18.3564) }}" class="form-control">
            @error('latitude')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-md-6">
            <label for="longitude" class="form-label"><strong>Longitude</strong></label>
            <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $destination->longitude ?? 121.6402) }}" class="form-control">
            @error('longitude')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Initialize map with the destination's current location
            const latitude = {{ old('latitude', $destination->latitude ?? 18.3564) }};
            const longitude = {{ old('longitude', $destination->longitude ?? 121.6402) }};
            const map = L.map('edit-map').setView([latitude, longitude], 13);

            // Add tile layers
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

            // Draggable marker for selecting new location
            const marker = L.marker([latitude, longitude], {
                draggable: true
            }).addTo(map);

            // Update input fields when marker is dragged
            marker.on('dragend', () => {
                const latLng = marker.getLatLng();
                document.getElementById('latitude').value = latLng.lat.toFixed(6);
                document.getElementById('longitude').value = latLng.lng.toFixed(6);
            });

            // Update marker position when input fields change
            const updateMarker = () => {
                const lat = parseFloat(document.getElementById('latitude').value) || latitude;
                const lng = parseFloat(document.getElementById('longitude').value) || longitude;
                marker.setLatLng([lat, lng]);
                map.setView([lat, lng], 13);
            };

            document.getElementById('latitude').addEventListener('input', updateMarker);
            document.getElementById('longitude').addEventListener('input', updateMarker);
        });
    </script>
</div>


                    <!-- Actions -->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-success">Update Destination</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
