@extends('user.shell')

@section('content')
    <div class="container">
        <h1>Hotels</h1>
        <div class="row">
            @foreach ($hotels as $hotel)
                <div class="col-md-4">
                    <div class="card mb-3">
                        @if ($hotel->cover)
                            <img src="{{ asset('storage/' . $hotel->cover) }}" class="card-img-top" alt="{{ $hotel->name }}">
                        @else
                            <div class="card-img-top bg-secondary text-white text-center py-5">No Image</div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $hotel->name }}</h5>
                            <p class="card-text"><strong>Location:</strong> {{ $hotel->location }}</p>
                            <p class="card-text"><strong>Price per Night:</strong>
                                {{ $hotel->price_per_night ? '₱' . number_format($hotel->price_per_night, 2) : 'Contact for pricing' }}
                            </p>
                            <a href="{{ route('user.hotels.show', $hotel->id) }}" class="btn btn-primary btn-sm">View
                                Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $hotels->links() }}
        </div>
    </div>
@endsection
