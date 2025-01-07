@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Add New Hotel</h1>

        <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Hotel Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Hotel Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <!-- Location -->
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" id="location" class="form-control">
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

            <!-- Social Media Links -->
            <div class="mb-3">
                <label for="social_media" class="form-label">Social Media Links (JSON)</label>
                <textarea name="social_media" id="social_media" rows="3" class="form-control"
                    placeholder='{"facebook":"https://facebook.com","instagram":"https://instagram.com"}'></textarea>
            </div>

            <!-- Services -->
            <div class="mb-3">
                <label for="services" class="form-label">Services Offered</label>
                <textarea name="services" id="services" rows="3" class="form-control"></textarea>
            </div>

            <!-- Availability -->
            <div class="mb-3">
                <label for="availability" class="form-label">Availability</label>
                <select name="availability" id="availability" class="form-select">
                    <option value="1">Available</option>
                    <option value="0">Unavailable</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Add Hotel</button>
        </form>
    </div>
@endsection
