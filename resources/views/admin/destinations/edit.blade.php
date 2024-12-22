@extends('admin.shell')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Edit Destination: {{ $destination->name }}</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.destinations.update', $destination->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label"><strong>Name</strong></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $destination->name) }}"
                            class="form-control" required>
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div class="mb-3">
                        <label for="location" class="form-label"><strong>Location</strong></label>
                        <input type="text" id="location" name="location"
                            value="{{ old('location', $destination->location) }}" class="form-control">
                        @error('location')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Contact -->
                    <div class="mb-3">
                        <label for="contact" class="form-label"><strong>Contact</strong></label>
                        <input type="text" id="contact" name="contact"
                            value="{{ old('contact', $destination->contact) }}" class="form-control">
                        @error('contact')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label"><strong>Email</strong></label>
                        <input type="email" id="email" name="email" value="{{ old('email', $destination->email) }}"
                            class="form-control">
                        @error('email')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Entrance Fee -->
                    <div class="mb-3">
                        <label for="entrance_fee" class="form-label"><strong>Entrance Fee</strong></label>
                        <input type="number" id="entrance_fee" name="entrance_fee"
                            value="{{ old('entrance_fee', $destination->entrance_fee) }}" class="form-control"
                            step="0.01">
                        @error('entrance_fee')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Availability -->
                    <div class="mb-3">
                        <label for="availability" class="form-label"><strong>Availability</strong></label>
                        <select id="availability" name="availability" class="form-select">
                            <option value="1"
                                {{ old('availability', $destination->availability) == 1 ? 'selected' : '' }}>Available
                            </option>
                            <option value="0"
                                {{ old('availability', $destination->availability) == 0 ? 'selected' : '' }}>Unavailable
                            </option>
                        </select>
                        @error('availability')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Social Media -->
                    <div class="mb-3">
                        <label for="social_media" class="form-label"><strong>Social Media (JSON format)</strong></label>
                        <textarea id="social_media" name="social_media" class="form-control" rows="3">{{ old('social_media', $destination->social_media) }}</textarea>
                        @error('social_media')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.destinations.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-success">Update Destination</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
