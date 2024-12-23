@extends('admin.shell')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>{{ $destination->name }}</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Location:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $destination->location ?? 'N/A' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Contact:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $destination->contact ?? 'N/A' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Email:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $destination->email ?? 'N/A' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Entrance Fee:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $destination->entrance_fee ? '₱' . number_format($destination->entrance_fee, 2) : 'Free' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Availability:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $destination->availability ? 'Available' : 'Unavailable' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Services Offered:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $destination->service_offer ?? 'None' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Events:</strong>
                    </div>
                    <div class="col-md-8">
                        {{ $destination->events ?? 'No events listed' }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Social Media:</strong>
                    </div>
                    <div class="col-md-8">
                        @if ($destination->social_media)
                            @foreach (json_decode($destination->social_media, true) as $platform => $link)
                                <a href="{{ $link }}" target="_blank"
                                    class="btn btn-link">{{ ucfirst($platform) }}</a>
                            @endforeach
                        @else
                            No social media links
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>

        <h4>Related Videos</h4>
        <div class="video-list">
            @if ($videos->isEmpty())
                <p>No videos available for this destination.</p>
            @else
                @foreach ($videos as $video)
                    <div class="card mb-3 {{ $video->isReviewed ? 'bg-info' : 'bg-warning' }}">
                        <div class="card-body">
                            <h5 class="card-title">
                                <span class="video-title" id="video-title-{{ $video->id }}">{{ $video->title }}</span>
                            </h5>
                            <p class="card-text">
                                <span class="video-description"
                                    id="video-description-{{ $video->id }}">{{ $video->description }}</span>
                            </p>
                            <a href="{{ $video->url }}" target="_blank" class="btn btn-link">Watch Video</a>
                            @if (!$video->isReviewed)
                                <p class="card-text">This video is pending review.</p>
                                <form action="{{ route('admin.videos.review', $video->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

    </div>
@endsection
