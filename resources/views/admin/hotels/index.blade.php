@extends('layouts.admin')

@section('content')

<h1 class="mt-4">Hotels</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Hotels</li>
</ol>
<div class="container">
    <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary mb-3">Add New Hotel</a>
    <div class="row g-3"> <!-- Added g-3 for spacing -->
        @foreach ($hotels as $hotel)
            <div class="col-md-4">
                <div class="card" style="height: 100%; display: flex; flex-direction: column;">
                    <div class="image-container" style="height: 200px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                        @if ($hotel->cover)
                            <img src="{{ asset('storage/' . $hotel->cover) }}" class="card-img-top" alt="{{ $hotel->name }}" style="object-fit: cover; height: 100%; width: 100%;">
                        @else
                            <div class="bg-secondary text-white text-center w-100 h-100 d-flex align-items-center justify-content-center">No Image</div>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $hotel->name }}</h5>
                        <p class="card-text"><strong>Location:</strong> {{ $hotel->location }}</p>
                        <p class="card-text"><strong>Price per Night:</strong>
                            {{ $hotel->price_per_night ? '₱' . number_format($hotel->price_per_night, 2) : 'Contact for pricing' }}
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('admin.hotels.show', $hotel->id) }}" class="btn btn-primary btn-sm">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $hotels->links() }}
    </div>
</div>
@endsection
