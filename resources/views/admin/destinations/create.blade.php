@extends('admin.shell')

@section('content')
    <h1>Create Destination</h1>

    <div class="container mt-5">
        <form method="POST" action="{{ route('admin.destinations.store') }}">
            @csrf
            <div class="row">
                <!-- Name -->
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Location -->
                <div class="col-md-6 mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" name="location" id="location"
                        class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}">
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- Contact -->
                <div class="col-md-6 mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" name="contact" id="contact"
                        class="form-control @error('contact') is-invalid @enderror" value="{{ old('contact') }}">
                    @error('contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- Entrance Fee -->
                <div class="col-md-6 mb-3">
                    <label for="entrance_fee" class="form-label">Entrance Fee</label>
                    <input type="number" step="0.01" name="entrance_fee" id="entrance_fee"
                        class="form-control @error('entrance_fee') is-invalid @enderror" value="{{ old('entrance_fee') }}">
                    @error('entrance_fee')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Availability -->
                <div class="col-md-6 mb-3">
                    <label for="availability" class="form-label">Availability</label>
                    <select name="availability" id="availability"
                        class="form-select @error('availability') is-invalid @enderror">
                        <option value="1" {{ old('availability') == 1 ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ old('availability') == 0 ? 'selected' : '' }}>Not Available</option>
                    </select>
                    @error('availability')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Social Media -->
            <div class="mb-3">
                <label for="social_media" class="form-label">Social Media (JSON format)</label>
                <textarea name="social_media" id="social_media" class="form-control @error('social_media') is-invalid @enderror"
                    rows="3">{{ old('social_media') }}</textarea>
                @error('social_media')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Create Destination</button>
            </div>
        </form>
    </div>
@endsection
