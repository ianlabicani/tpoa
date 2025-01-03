@extends('user.shell')

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
                <a href="{{ route('guest.history') }}#gallery-section" class="btn btn-primary" id="backToGalleryBtn">Back to
                    Gallery</a>
            </div>
        </div>
    </div>
@endsection

<script>
    // JavaScript for smooth scrolling to the gallery section
    document.getElementById('backToGalleryBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default anchor click behavior

        // Get the target gallery section and header (if any)
        const target = document.querySelector('#gallery-section');
        const header = document.querySelector('header'); // Adjust if your header is a different element
        const headerHeight = header ? header.offsetHeight : 0;

        // Scroll to the section, adjusting for the header height
        window.scrollTo({
            top: target.offsetTop - headerHeight, // Adjusting scroll to account for header
            behavior: 'smooth'
        });
    });
</script>
