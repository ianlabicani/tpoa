@extends('user.shell')

@section('content')
    <div class="container">
        <div class="card mb-4">
            <!-- Hotel Cover Image -->
            @if ($hotel->cover)
                <img src="{{ asset('storage/' . $hotel->cover) }}" class="card-img-top" alt="{{ $hotel->name }}">
            @else
                <div class="card-img-top bg-secondary text-white text-center py-5">
                    No Image Available
                </div>
            @endif

            <div class="card-body">
                <!-- Hotel Name -->
                <h1 class="card-title">{{ $hotel->name }}</h1>

                <!-- Location -->
                <p class="card-text">
                    <strong>Location:</strong> {{ $hotel->location ?? 'Not specified' }}
                </p>

                <!-- Price Per Night -->
                <p class="card-text">
                    <strong>Price Per Night:</strong>
                    {{ $hotel->price_per_night ? '₱' . number_format($hotel->price_per_night, 2) : 'Not specified' }}
                </p>

                <!-- Description -->
                <p class="card-text">
                    <strong>Description:</strong>
                    {{ $hotel->description ?? 'No description available' }}
                </p>

                <!-- Services Offered -->
                <p class="card-text">
                    <strong>Services Offered:</strong>
                    {{ $hotel->services ?? 'No services specified' }}
                </p>

                <!-- Availability -->
                <p class="card-text">
                    <strong>Availability:</strong>
                    {{ $hotel->availability ? 'Available' : 'Unavailable' }}
                </p>

                <!-- Social Media Links -->
                @if ($hotel->social_media)
                    <p class="card-text">
                        <strong>Follow Us:</strong>
                    </p>
                    <div>
                        @php
                            $socialMedia = json_decode($hotel->social_media, true);
                        @endphp
                        @foreach ($socialMedia as $platform => $link)
                            <a href="{{ $link }}" target="_blank" class="btn btn-sm btn-link">
                                {{ ucfirst($platform) }}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="card-footer d-flex justify-content-between">
                <!-- Back Button -->
                <a href="{{ route('user.hotels.index') }}" class="btn btn-secondary">Back to Hotels</a>

            </div>
        </div>

    </div>
@endsection
