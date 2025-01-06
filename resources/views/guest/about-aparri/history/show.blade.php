@extends('guest.shell')

@section('content')
    <div class="container py-5">
        <div class="text-center">
            <!-- Image Container with Header and Description -->
            <div class="image-container">
                <img src="{{ asset($image['src']) }}" alt="{{ $image['title'] }}" class="img-fluid rounded shadow mb-4">
                <h3 class="mt-3">{{ $image['title'] }}</h3>
                <p class="lead" style="text-align: justify; max-width: 800px; margin: 0 auto;">{{ $image['description'] }}
                </p>
                <small>Source: {{ $image['source'] }}</small>
            </div>

            <!-- Back to Gallery Button -->
            <div class="mt-4">
                <a href="{{ route('history') }}#gallery-section" class="btn btn-primary" id="backToGalleryBtn">Back to
                    Gallery</a>
            </div>
        </div>
    </div>
@endsection


