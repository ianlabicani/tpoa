@extends('user.shell')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center">Destinations</h1>

        <div class="row">
            @foreach ($destinations as $destination)
                <div class=" col-md-4 mb-4">
                    <div class="card h-100">
                        <!-- Destination Cover -->
                        @if ($destination->day_images && count(json_decode($destination->day_images, true)) > 0)
                            @php $dayImages = json_decode($destination->day_images, true); @endphp
                            <img src="{{ asset('storage/' . $dayImages[0]) }}" class="card-img-top"
                                alt="{{ $destination->name }}">
                        @else
                            <div class="card-img-top bg-secondary text-white text-center py-5">
                                No Image
                            </div>
                        @endif

                        <div class="card-body">
                            <!-- Destination Name -->
                            <h5 class="card-title">{{ $destination->name }}</h5>

                            <!-- Destination Location -->
                            <p class="card-text">
                                <strong>Location:</strong> {{ $destination->location }}
                            </p>

                            <!-- Entrance Fee -->
                            <p class="card-text">
                                <strong>Entrance Fee:</strong>
                                {{ $destination->entrance_fee ? '₱' . number_format($destination->entrance_fee, 2) : 'Free' }}
                            </p>

                            <!-- Availability -->
                            <p class="card-text">
                                <strong>Availability:</strong>
                                {{ $destination->availability ? 'Available' : 'Unavailable' }}
                            </p>

                            <!-- Service Offer -->
                            <p class="card-text">
                                <strong>Service Offer:</strong> {{ $destination->service_offer }}
                            </p>

                            <!-- Social Media Links -->
                            @if ($destination->social_media)
                                <div>
                                    <strong>Follow:</strong>
                                    @php $socialMedia = json_decode($destination->social_media, true); @endphp
                                    @foreach ($socialMedia as $platform => $link)
                                        <a href="{{ $link }}" target="_blank" class="btn btn-sm btn-link">
                                            {{ ucfirst($platform) }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="card-footer text-center">
                            <a href="{{ route('user.destinations.show', $destination->id) }}"
                                class="btn btn-primary btn-sm">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $destinations->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
