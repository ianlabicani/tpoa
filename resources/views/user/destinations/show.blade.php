@extends('user.shell')

@section('content')


    <div class="container mt-4">
        <!-- Destination Section -->
        <div class="card shadow-sm p-4">
            <div class="row">
                <!-- Column 1: Destination Details -->
                <div class="col-md-6">
                    <h3 class="mb-3">
                        <i class="fas fa-map-marker-alt me-2"></i>{{ $destination->name }}
                    </h3>
                    <p><strong>Location:</strong> {{ $destination->location ?? 'Not specified' }}</p>
                    <p><strong>Contact:</strong> {{ $destination->contact ?? 'Not specified' }}</p>
                    <p><strong>Email:</strong> {{ $destination->email ?? 'Not specified' }}</p>
                    <p><strong>Entrance Fee:</strong>
                        {{ $destination->entrance_fee ? '₱' . number_format($destination->entrance_fee, 2) : 'Not specified' }}
                    </p>
                    <p><strong>Availability:</strong> {{ $destination->availability ? 'Available' : 'Unavailable' }}</p>
                    <p><strong>How to Get There:</strong></p>
                    <div>{!! $destination->how_to_get_there ?? 'No information available' !!}</div>

                    <!-- Day Images -->
                    <div class="my-4">
                        <h4 class="mb-3">Day Images</h4>
                        <div class="row mt-4">
                            @forelse (json_decode($destination->day_images, true) ?? [] as $dayImage)
                                <div class="col-md-6 mb-3">
                                    <img src="{{ asset('storage/' . $dayImage) }}" alt="Day Image" class="img-fluid rounded"
                                        style="object-fit: cover; height: 250px;">
                                </div>
                            @empty
                                <p class="text-muted">No day images available.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Night Images -->
                    <div class="my-4">
                        <h4 class="mb-3">Night Images</h4>
                        <div class="row mt-4">
                            @forelse (json_decode($destination->night_images, true) ?? [] as $nightImage)
                                <div class="col-md-6 mb-3">
                                    <img src="{{ asset('storage/' . $nightImage) }}" alt="Night Image"
                                        class="img-fluid rounded" style="object-fit: cover; height: 250px;">
                                </div>
                            @empty
                                <p class="text-muted">No night images available.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Feebacks Card -->
                    <div class="card shadow-sm border rounded">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Feedbacks </h5>

                        </div>
                        <div class="card-body">
                            @if ($feedbacks->isEmpty())
                                <p class="text-muted">No feedbacks available for this destination. Be the first
                                    to leave one!</p>
                            @else
                                @foreach ($feedbacks as $feedback)
                                    <div class="border-bottom pb-3 mb-3">
                                        <strong>{{ $feedback->user->name }}</strong>
                                        <span
                                            class="text-muted">({{ $feedback->created_at->format('M d, Y') }})</span>

                                        <!-- Feedback content -->
                                        @if (auth()->check() && auth()->user()->id === $feedback->user_id)
                                            <form method="POST"
                                                action="{{ route('user.feedbacks.update', ['destination' => $destination, 'feedback' => $feedback]) }}"
                                                class="d-inline" id="feedback-form-{{ $feedback->id }}">
                                                @csrf
                                                @method('PUT')

                                                <div class="editable-feedback">
                                                    <div id="feedback-content-{{ $feedback->id }}"
                                                        class="editable-content"
                                                        data-feedback-id="{{ $feedback->id }}">
                                                        {{ $feedback->comment }}
                                                    </div>
                                                    <input type="hidden" name="comment"
                                                        class="feedback-comment-input">
                                                </div>

                                                <!-- Buttons for Save and Cancel -->
                                                <button type="button" class="btn btn-primary btn-sm"
                                                    id="edit-btn-{{ $feedback->id }}"
                                                    onclick="toggleEdit({{ $feedback->id }})">Edit</button>
                                                <button type="submit" class="btn btn-success btn-sm d-none"
                                                    id="save-btn-{{ $feedback->id }}">Save</button>
                                                <button type="button" class="btn btn-danger btn-sm d-none"
                                                    id="cancel-btn-{{ $feedback->id }}"
                                                    onclick="cancelEdit({{ $feedback->id }})">Cancel</button>
                                            </form>
                                        @else
                                            <p>{{ $feedback->comment }}</p>
                                        @endif

                                        <!-- Like and Dislike Buttons -->
                                        <div class="d-flex align-items-center mt-2 gap-3">
                                            @php
                                                $userReaction =
                                                    $feedback->reactions
                                                        ->where('user_id', auth()->id())
                                                        ->first()->reaction ?? null;
                                            @endphp

                                            <button
                                                class="reaction-button like-button {{ $userReaction === 'like' ? 'active' : '' }}"
                                                data-feedback-id="{{ $feedback->id }}">
                                                <i class="fas fa-thumbs-up"></i>
                                                <span
                                                    id="like-count-{{ $feedback->id }}">{{ $feedback->reactions->where('reaction', 'like')->count() }}</span>
                                            </button>

                                            <button
                                                class="reaction-button dislike-button {{ $userReaction === 'dislike' ? 'active' : '' }}"
                                                data-feedback-id="{{ $feedback->id }}">
                                                <i class="fas fa-thumbs-down"></i>
                                                <span
                                                    id="dislike-count-{{ $feedback->id }}">{{ $feedback->reactions->where('reaction', 'dislike')->count() }}</span>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <!-- Leave Feedback Form -->
                            <form
                                action="{{ route('user.feedbacks.store', ['destination' => $destination->id]) }}"
                                method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="feedback" class="form-label">Leave a Feedback</label>
                                    <textarea name="comment" class="form-control" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
 
                </div>


                <!-- Column 2: Map and Related Videos -->
                <div class="col-md-6">
                    <!-- Map -->
                    <div id="map" style="height: 300px;" class="mb-4"></div>

                    <h4>Related Videos</h4>
                    @if ($videos->isEmpty())
                        <p>No videos available for this destination.</p>
                    @else
                        <div class="row">
                            @foreach ($videos as $video)
                                @if ($video->isReviewed)
                                    <div class="col-md-12 mb-3">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <!-- Video Title -->
                                                <h5 class="card-title">{{ $video->title }}</h5>
                                                <!-- Embed YouTube Video -->
                                                @if (strpos($video->url, 'youtube.com') !== false || strpos($video->url, 'youtu.be') !== false)
                                                    @php
                                                        if (strpos($video->url, 'youtu.be') !== false) {
                                                            $videoId = basename($video->url);
                                                            $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                                        } elseif (strpos($video->url, 'youtube.com') !== false) {
                                                            parse_str(parse_url($video->url, PHP_URL_QUERY), $params);
                                                            $embedUrl = 'https://www.youtube.com/embed/' . $params['v'];
                                                        }
                                                    @endphp
                                                    <iframe width="100%" height="200" src="{{ $embedUrl }}"
                                                        frameborder="0" allowfullscreen></iframe>
                                                @else
                                                    <a href="{{ $video->url }}" target="_blank"
                                                        class="btn btn-outline-primary">Watch Video</a>
                                                @endif
                                                <!-- Video Description -->
                                                <p class="mt-2">{{ $video->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-12 mb-3">
                                        <div class="alert alert-warning">
                                            <strong>Pending Approval:</strong> This video is awaiting admin approval.
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif


                    <form action="{{ route('user.destinations.videos.store', $destination->id) }}" method="POST">
                        @csrf
                        <h4>Add Video</h4>
                        <div id="video-container">
                            <div class="video-group">
                                <div class="mb-3">
                                    <label for="video_title" class="form-label">Video Title</label>
                                    <input type="text" name="video_title" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="video_url" class="form-label">Video URL or Embed Code</label>
                                    <input type="url" name="video_url" class="form-control"
                                        placeholder="https://example.com" required>
                                </div>
                                <div class="mb-3">
                                    <label for="video_description" class="form-label">Video Description</label>
                                    <textarea name="video_description" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>



                </div>
            </div>
        </div>


    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const latitude = {{ $destination->latitude }};
            const longitude = {{ $destination->longitude }};
            const locationName = "{{ $destination->name ?? 'Unnamed Location' }}";

            const map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            L.marker([latitude, longitude]).addTo(map)
                .bindPopup(`<b>${locationName}</b>`)
                .openPopup();
        });
    </script>
@endsection
