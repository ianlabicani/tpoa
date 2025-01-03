@extends('guest.shell')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>{{ $destination->name }}</h3>
            </div>
            <div class="card-body">
                <!-- Map Section -->
                <div class="map-container mb-4">
                    <div id="map" class="rounded" style="height: 500px; width: 100%;"></div>
                </div>

                <script>
                    window.onload = function() {
                        @if ($destination->latitude && $destination->longitude)
                            var latitude = {{ $destination->latitude }};
                            var longitude = {{ $destination->longitude }};
                        @else
                            var latitude = 0;
                            var longitude = 0;
                        @endif
                        var map = L.map('map').setView([latitude, longitude], 13);

                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap contributors'
                        }).addTo(map);
                        L.marker([latitude, longitude]).addTo(map)
                            .bindPopup('Destination: {{ $destination->name }}')
                            .openPopup();
                    };
                </script>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Location:</strong> {{ $destination->location ?? 'N/A' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Contact:</strong> {{ $destination->contact ?? 'N/A' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Email:</strong> {{ $destination->email ?? 'N/A' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Entrance Fee:</strong>
                        {{ $destination->entrance_fee ? '₱' . number_format($destination->entrance_fee, 2) : 'Free' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Availability:</strong> {{ $destination->availability ? 'Available' : 'Unavailable' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Services Offered:</strong> {{ $destination->service_offer ?? 'None' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Events:</strong> {{ $destination->events ?? 'No events listed' }}
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Social Media:</strong>
                        @if ($destination->social_media)
                            @foreach (json_decode($destination->social_media, true) as $platform => $link)
                                <a href="{{ $link }}" target="_blank"
                                    class="btn btn-outline-primary btn-sm me-2">{{ ucfirst($platform) }}</a>
                            @endforeach
                        @else
                            No social media links
                        @endif
                    </div>
                    <div class="col-md-12">
                        <strong>How to get there:</strong>
                        {!! $destination->how_to_get_there ?? '<p>No instructions available at the moment.</p>' !!}
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <!-- Day Images -->
        <div class="my-4">
            <h4 class="mb-3">Day Images</h4>
            <div class="row g-3">
                @forelse (json_decode($destination->day_images, true) ?? [] as $dayImage)
                    <div class="col-md-3">
                        <div class="card shadow-sm h-100">
                            <a href="{{ asset('storage/' . $dayImage) }}" target="_blank">
                                <img src="{{ asset('storage/' . $dayImage) }}" alt="Day Image" class="card-img-top rounded"
                                    style="height: 180px; object-fit: cover;">
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No day images available.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Night Images -->
        <div class="my-4">
            <h4 class="mb-3">Night Images</h4>
            <div class="row g-3">
                @forelse (json_decode($destination->night_images, true) ?? [] as $nightImage)
                    <div class="col-md-3">
                        <div class="card shadow-sm h-100">
                            <a href="{{ asset('storage/' . $nightImage) }}" target="_blank">
                                <img src="{{ asset('storage/' . $nightImage) }}" alt="Night Image"
                                    class="card-img-top rounded" style="height: 180px; object-fit: cover;">
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">No night images available.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Related Videos -->
        <div class="my-4">
            <h4>Related Videos</h4>
            @if ($videos->isEmpty())
                <p>No videos available for this destination.</p>
            @else
                <div class="row">
                    @foreach ($videos as $video)
                        <div class="col-md-6 mb-3">
                            <div class="card {{ $video->isReviewed ? 'border-info' : 'border-warning' }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $video->title }}</h5>
                                    <p class="card-text">{{ $video->description }}</p>
                                    <a href="{{ $video->url }}" target="_blank" class="btn btn-outline-primary">Watch
                                        Video</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Feedback Section -->
        <div class="my-4">
            <h4 class="mb-3">Feedbacks</h4>
            @foreach ($feedbacks as $feedback)
                {{-- @php
                    dd($feedback);
                @endphp --}}
                <div>
                    <strong>{{ $feedback->user->name }}</strong> ({{ $feedback->created_at->format('M d, Y') }})
                    <p>{{ $feedback->comment }}</p>

                    @if (auth()->check())
                        @php
                            $userReaction =
                                $feedback->reactions->where('user_id', auth()->id())->first()->reaction ?? null;
                        @endphp
                        <div>
                            <p>Likes: <span
                                    id="like-count-{{ $feedback->id }}">{{ $feedback->reactions->where('reaction', 'like')->count() }}</span>
                            </p>
                            <p>Dislikes: <span
                                    id="dislike-count-{{ $feedback->id }}">{{ $feedback->reactions->where('reaction', 'dislike')->count() }}</span>
                            </p>

                            <button class="btn btn-success like-button {{ $userReaction === 'like' ? 'active' : '' }}"
                                data-feedback-id="{{ $feedback->id }}">
                                Like
                            </button>
                            <button class="btn btn-danger dislike-button {{ $userReaction === 'dislike' ? 'active' : '' }}"
                                data-feedback-id="{{ $feedback->id }}">
                                Dislike
                            </button>
                        </div>
                        <hr>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                document.querySelectorAll(".like-button").forEach(button => {
                                    button.addEventListener("click", function() {
                                        const feedbackId = this.getAttribute("data-feedback-id");

                                        fetch(`{{ route('user.feedbacks.like', ':feedbackId') }}`.replace(
                                                ':feedbackId', feedbackId), {
                                                method: "POST",
                                                headers: {
                                                    "Content-Type": "application/json",
                                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                                }
                                            })
                                            .then(response => response.json())
                                            .then(data => {
                                                // Update counts
                                                document.getElementById(`like-count-${feedbackId}`).textContent =
                                                    data.likes;
                                                document.getElementById(`dislike-count-${feedbackId}`).textContent =
                                                    data.dislikes;

                                                // Update button states
                                                updateReactionUI(feedbackId, data.userReaction);
                                            })
                                            .catch(error => console.error("Error:", error));
                                    });
                                });

                                document.querySelectorAll(".dislike-button").forEach(button => {
                                    button.addEventListener("click", function() {
                                        const feedbackId = this.getAttribute("data-feedback-id");

                                        fetch(`{{ route('user.feedbacks.dislike', ':feedbackId') }}`.replace(
                                                ':feedbackId', feedbackId), {
                                                method: "POST",
                                                headers: {
                                                    "Content-Type": "application/json",
                                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                                }
                                            }).then(response => response.json())
                                            .then(data => {
                                                // Update counts
                                                document.getElementById(`like-count-${feedbackId}`).textContent =
                                                    data.likes;
                                                document.getElementById(`dislike-count-${feedbackId}`).textContent =
                                                    data.dislikes;

                                                // Update button states
                                                updateReactionUI(feedbackId, data.userReaction);
                                            })
                                            .catch(error => console.error("Error:", error));
                                    });
                                });

                                function updateReactionUI(feedbackId, userReaction) {
                                    const likeButton = document.querySelector(`.like-button[data-feedback-id="${feedbackId}"]`);
                                    const dislikeButton = document.querySelector(`.dislike-button[data-feedback-id="${feedbackId}"]`);

                                    // Reset button states
                                    likeButton.classList.remove("active");
                                    dislikeButton.classList.remove("active");

                                    // Set active state based on user reaction
                                    if (userReaction === "like") {
                                        likeButton.classList.add("active");
                                    } else if (userReaction === "dislike") {
                                        dislikeButton.classList.add("active");
                                    }
                                }
                            });
                        </script>
                    @else
                        <p>
                            <a href="{{ route('register') }}" class="text-decoration-none text-primary">
                                Likes: <span
                                    id="like-count-{{ $feedback->id }}">{{ $feedback->reactions->where('reaction', 'like')->count() }}</span>
                            </a>
                        </p>
                        <p>
                            <a href="{{ route('register') }}" class="text-decoration-none text-primary">
                                Dislikes: <span
                                    id="dislike-count-{{ $feedback->id }}">{{ $feedback->reactions->where('reaction', 'dislike')->count() }}</span>
                            </a>
                        </p>
                    @endif

                    <hr>
                </div>
            @endforeach
            @if ($feedbacks->isEmpty())
                <p>No feedbacks available for this destination.</p>
            @endif
        </div>

        <!-- Share Button Section -->
        <div class="my-4 d-flex align-items-center justify-content-center gap-3">
            <p id="share-count" class="mb-0 fs-5 fw-bold text-secondary">Shares: <span
                    id="share-count-value">{{ $destination->share_count }}</span>
            </p>

            <!-- Share Button -->
            <button type="button" class="btn btn-lg btn-primary d-block w-100" id="share-button">
                Share Destination
            </button>

            <!-- Hidden Text Area for Copying -->
            <textarea id="share-text" style="position: absolute; left: -9999px;">{{ route('destinations.show', ['destination' => $destination->id]) }} </textarea>

            <script>
                let shareCount = {{ $destination->share_count }};

                // Add an event listener for the "Share" button click
                document.getElementById('share-button').addEventListener('click', function() {
                    // Copy the share URL to the clipboard
                    let shareText = document.getElementById('share-text');
                    shareText.select();
                    document.execCommand('copy'); // This copies the text to the clipboard

                    // Use SweetAlert to notify the user
                    Swal.fire({
                        title: 'Link Copied!',
                        text: 'The share link has been copied to your clipboard.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });

                    // Perform the AJAX request to share the destination
                    fetch("{{ route('destinations.share', ['destination' => $destination]) }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                        })
                        .then(data => {
                            if (data.ok) {
                                // Update the share count dynamically
                                shareCount++;
                                document.getElementById('share-count-value').textContent = shareCount;
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'An error occurred while sharing the destination.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            Swal.fire({
                                title: 'Error',
                                text: 'An error occurred while sharing the destination.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                });
            </script>
        </div>
    </div>
@endsection
