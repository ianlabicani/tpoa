@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <!-- Total Visitors Card -->
        <div class="col-xl-4 col-md-6">
            <div class="card shadow-sm bg-primary text-white mb-4">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-0">Total Visitors</h5>
                        <p class="fs-4 mb-0">{{ $totalVisitors }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Reactions Card -->
        <div class="col-xl-4 col-md-6">
            <div class="card shadow-sm bg-warning text-white mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Total Reactions</h5>
                    <ul class="list-unstyled">
                        @foreach ($reactionCounts as $reaction)
                            <li>
                                <i class="fas fa-thumbs-up me-2"></i>
                                {{ ucfirst($reaction->reaction) }}: <strong>{{ $reaction->total_count }}</strong>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between bg-dark">
                    <a class="small text-white stretched-link" href="{{ route('admin.details') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        
          <!-- Total Videos Card -->
<div class="col-xl-4 col-md-6">
    <div class="card shadow-sm bg-info text-white mb-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Total Videos</h5>
            <ul class="list-unstyled">
                @foreach ($videoCounts as $videoCount)
                    <li>
                        <i class="fas fa-video me-2"></i>
                        Destination 
                        <strong>{{ $videoCount->destination->name ?? 'Unknown' }}</strong>: 
                        <strong>{{ $videoCount->total_videos }}</strong> Videos
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
    
    


    </div>

@endsection
