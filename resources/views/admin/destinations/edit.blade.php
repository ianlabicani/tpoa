@extends('admin.shell')

@section('content')
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3>Edit Destination: {{ $destination->name }}</h3>
                <a href="{{ route('admin.destinations.index') }}" class="btn btn-light btn-sm">Back to List</a>
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

                    <!-- Entrance Fee & Availability -->
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

                    {{-- social media --}}
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
                        <textarea id="how_to_get_there" name="how_to_get_there" rows="5" class="form-control">{{ old('how_to_get_there', $destination->how_to_get_there) }}</textarea>
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
                        <label for="location_map" class="form-label"><strong>Select Location</strong></label>
                        <div id="map" style="height: 400px;"></div>
                        <input type="hidden" id="latitude" name="latitude"
                            value="{{ old('latitude', $destination->latitude ?? '') }}">
                        <input type="hidden" id="longitude" name="longitude"
                            value="{{ old('longitude', $destination->longitude ?? '') }}">
                        <script>
                            var map = L.map('map').setView([{{ old('latitude', $destination->latitude ?? 18.356104) }},
                                {{ old('longitude', $destination->longitude ?? 121.63988) }}
                            ], 13);
                            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '© OpenStreetMap contributors'
                            }).addTo(map);
                            var marker = L.marker([{{ old('latitude', $destination->latitude ?? 18.356104) }},
                                {{ old('longitude', $destination->longitude ?? 121.63988) }}
                            ], {
                                draggable: true
                            }).addTo(map);
                            marker.on('dragend', function(event) {
                                var latLng = event.target.getLatLng();
                                document.getElementById('latitude').value = latLng.lat;
                                document.getElementById('longitude').value = latLng.lng;
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
