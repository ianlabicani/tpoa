@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">Create Destination</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Create Destination</li>
    </ol>
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Add New Destination</h3>
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
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="location" class="form-label"><strong>Location</strong></label>
                                <input type="text" id="location" name="location" value="{{ old('location') }}" class="form-control">
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
                                <input type="text" id="contact" name="contact" value="{{ old('contact') }}" class="form-control">
                                @error('contact')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="email" class="form-label"><strong>Email</strong></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
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
                                <input type="number" id="entrance_fee" name="entrance_fee" value="{{ old('entrance_fee') }}" class="form-control" step="0.01">
                                @error('entrance_fee')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="availability" class="form-label"><strong>Availability</strong></label>
                                <select id="availability" name="availability" class="form-select">
                                    <option value="1" {{ old('availability') == 1 ? 'selected' : '' }}>Available</option>
                                    <option value="0" {{ old('availability') == 0 ? 'selected' : '' }}>Unavailable</option>
                                </select>
                                @error('availability')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="mb-3">
                        <label for="social_media" class="form-label"><strong>Social Media Links</strong></label>
                        <textarea id="social_media" name="social_media" rows="5" class="form-control">{{ old('social_media') }}</textarea>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                ClassicEditor.create(document.querySelector('#social_media')).catch(error => console.error(error));
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

                     <!-- Description & History -->
                     <div class="mb-3">
                        <label for="description" class="form-label"><strong>Description</strong></label>
                        <textarea id="description" name="description" rows="5" class="form-control">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
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
                    </div>

                    <!-- Location Map -->
                    <div class="mb-4">
                        <label for="location_map" class="form-label"><strong>Set Location</strong></label>
                        <div id="map" style="height: 400px;"></div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="latitude" class="form-label"><strong>Latitude</strong></label>
                                <input type="text" id="latitude" name="latitude" value="{{ old('latitude', 18.3564) }}" class="form-control">
                                @error('latitude')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="longitude" class="form-label"><strong>Longitude</strong></label>
                                <input type="text" id="longitude" name="longitude" value="{{ old('longitude', 121.6402) }}" class="form-control">
                                @error('longitude')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const map = L.map('map').setView([18.3564, 121.6402], 13);
                                const marker = L.marker([18.3564, 121.6402], { draggable: true }).addTo(map);

                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                    attribution: '&copy; OpenStreetMap contributors'
                                }).addTo(map);

                                marker.on('dragend', () => {
                                    const latLng = marker.getLatLng();
                                    document.getElementById('latitude').value = latLng.lat.toFixed(6);
                                    document.getElementById('longitude').value = latLng.lng.toFixed(6);
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
