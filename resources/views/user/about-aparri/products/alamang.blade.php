@extends('user.shell')

@section('content')
<section class="single-page-header"></section>
<section class="py-5 bg-light">
    <div class="container">
        <!-- Product Title -->
        <div class="text-center mb-4">
            <h1 class="fw-bold">Alamang</h1>
            <p class="text-muted">Discover the unique qualities of this Aparri product.</p>
        </div>
        
        <!-- Product Image -->
        <div class="text-center">
            <img src="{{ route('user.alamang') }}" class="img-fluid rounded shadow" alt="Alamang" style="max-height: 500px; object-fit: cover;">
        </div>

        <!-- Product Description -->
        <div class="mt-5">
            <h3 class="fw-bold">Description</h3>
            <p class="text-muted"></p>
        </div>

        <!-- Call to Action -->
        <div class="mt-5 text-center">
            <a href="{{ route('user.products') }}" class="btn btn-primary px-4 py-2">Back to Products</a>
        </div>
    </div>
</section>
@endsection
