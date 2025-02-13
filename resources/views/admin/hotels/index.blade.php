@extends('layouts.admin')

@section('content')

<h1 class="mt-4">Hotels</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Hotels</li>
</ol>

<div class="container">
   
    <div class="row g-3"> <!-- Spacing between columns -->
        @foreach ($hotels as $hotel)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="image-container" style="height: 200px; overflow: hidden; display: flex; justify-content: center; align-items: center;">
                        @if ($hotel->cover)
                         <a href="{{ route('admin.hotels.show', $hotel->id)     }}"><img src="{{ asset('storage/' . $hotel->cover) }}" 
                            class="card-img-top" 
                            alt="{{ $hotel->name }}" 
                            style="object-fit: cover; height: 100%; width: 100%;"></a>   
                        @else
                            <div class="bg-secondary text-white text-center w-100 h-100 d-flex align-items-center justify-content-center">No Image</div>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <!-- Hotel Information -->
                        <h5 class="card-title">{{ $hotel->name }}</h5>
                       
                  
                     
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Section -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <p class="text-muted">
            Showing {{ $hotels->firstItem() }} to {{ $hotels->lastItem() }} of {{ $hotels->total() }} hotels
        </p>
        <div class="d-flex justify-content-center">
            {{ $hotels->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<!-- Additional Styles -->
<style>
    .card {
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .breadcrumb {
        background-color: #f8f9fa;
    }

    .pagination .page-item .page-link {
        color: #007bff;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin: 0 2px;
        transition: all 0.3s ease;
    }

    .pagination .page-item .page-link:hover {
        background-color: #007bff;
        color: #fff;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }
</style>

@endsection
    