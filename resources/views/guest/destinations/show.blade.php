@extends('guest.shell')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>{{ $destination->name }}</h3>
            </div>
            <div class="card-body">
                <!-- Displaying feedbacks -->
                @foreach ($feedbacks as $feedback)
                    <div>
                        <strong>{{ $feedback->user->name }}</strong> ({{ $feedback->created_at->format('M d, Y') }})

                        <!-- Feedback content editable if current user owns it -->

                        <p>{{ $feedback->comment }}</p>


                        <hr>
                    </div>
                @endforeach
            </div>
            <div class="card-footer text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <hr>

        <h4>Related Videos</h4>
        <div class="video-list">
            @if ($videos->isEmpty())
                <p>No videos available for this destination.</p>
            @else
                @foreach ($videos as $video)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                <span class="video-title" id="video-title-{{ $video->id }}">{{ $video->title }}</span>
                            </h5>
                            @if ($video->isReviewed)
                                <p class="card-text">
                                    <span class="video-description"
                                        id="video-description-{{ $video->id }}">{{ $video->description }}</span>
                                </p>
                                <a href="{{ $video->url }}" target="_blank" class="btn btn-link">Watch Video</a>
                            @else
                                <span class="badge bg-secondary">Under Review</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
