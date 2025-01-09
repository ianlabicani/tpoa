@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">Destinations</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Destinations</li>
    </ol>

    <div class="row">
        @foreach ($visitorCounts as $destination)
            <div class="col-xl-4 col-md-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $destination->name }}</h5>
                        <p>{{ $destination->description }}</p>
                        
                        <!-- Display likes and dislikes counts -->
                        <p><strong>Likes:</strong> {{ $destination->likes_count }}</p>
                        <p><strong>Dislikes:</strong> {{ $destination->dislikes_count }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    {{ $visitorCounts->links() }}
@endsection
