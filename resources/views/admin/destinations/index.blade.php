@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">Destinations</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Destinations</li>
    </ol>
    <div class="container mt-5">
        <!-- Page Title -->

        <div class="row">
            @foreach ($destinations as $destination)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100 border-0">
                        <!-- Destination Cover -->
                        @if ($destination->day_images && count(json_decode($destination->day_images, true)) > 0)
                            @php $dayImages = json_decode($destination->day_images, true); @endphp
                            
                                <a href="{{ route('admin.destinations.show', $destination->id) }}"
                                    class=" btn-sm px-4">
                                    <img src="{{ asset('storage/' . $dayImages[0]) }}" class="card-img-top rounded-top"
                                    alt="{{ $destination->name }}" style="height: 200px; object-fit: cover;">
                                </a>
                        @else
                            <div class="card-img-top bg-secondary text-white text-center py-5 rounded-top">
                                No Image Available
                            </div>
                        @endif

                        <div class="card-body text-center">
                            <!-- Destination Name -->
                            <h5 class="card-title mb-3">{{ $destination->name }}</h5>

                         
                        </div>

                       
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $destinations->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
