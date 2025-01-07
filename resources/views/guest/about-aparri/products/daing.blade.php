@extends('guest.shell')


@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <!-- Product Title -->
        <div class="text-center mb-4">
            <h1 class="fw-bold">Daing</h1>
            <p class="text-muted">Discover the unique qualities of this Aparri product.</p>
        </div>
        
        <!-- Product Image -->
        <div class="text-center">
            <img src="{{ asset('image/daing.jpg') }}" class="img-fluid rounded shadow" alt="Alamang" style="height: 450px; width:700px ">
        </div>

        <!-- Product Description -->
        <div class="mt-5">
            <h3 >Description</h3>
            <p class="card-text">Nipa shingle and wine-making are viable sources of income for many in the
                Western barangays.</p>
        </div>

        <!-- Call to Action -->
        <div class="mt-5 text-center">
            <a href="{{ route('products') }}" class="btn btn-primary px-4 py-2">Back to Products</a>
        </div>
    </div>
</section>
@endsection
