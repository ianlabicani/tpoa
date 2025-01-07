@extends('guest.shell')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <!-- Product Title -->
        <div class="text-center mb-4">
            <h1 class="fw-bold">Alamang</h1>
            <p class="text-muted">Discover the unique qualities of this Aparri product.</p>
        </div>
        
        <!-- Product Image -->
        <div class="text-center">
            <img src="{{ asset('image/aramang.jpg') }}" class="img-fluid rounded shadow" alt="Alamang" style="height: 450px; width:700px ">
        </div>

        <!-- Product Description -->
        <div class="mt-5">
            <h3 >Description</h3>
            <p class="text-muted">When the Term 'aramang' (Ilocano for alamang) is mentioned, the town being referred to is none other than Aparri, Cagayan, which nature has uniquely blessed with the soft-shelled pink shrimp specie scientifically known as Nematopalaemon tenuipes or spider shrimp. It is Aparri's “One Town, One Product” commodity.</p>
        </div>

        <!-- Call to Action -->
        <div class="mt-5 text-center">
            <a href="{{ route('products') }}" class="btn btn-primary px-4 py-2">Back to Products</a>
        </div>
    </div>
</section>
@endsection
