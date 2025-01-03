<style>
    button.active {
        background-color: #007bff;
        color: white;
    }
</style>

{{-- TODO:
    map
    how to get here?
    day and night pictures
--}}

@extends('user.shell')

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

        <!-- Displaying feedbacks -->
        @foreach ($feedbacks as $feedback)
            <div>
                <strong>{{ $feedback->user->name }}</strong> ({{ $feedback->created_at->format('M d, Y') }})

                <!-- Feedback content editable if current user owns it -->
                @if (auth()->user()->id === $feedback->user_id)
                    <form method="POST"
                        action="{{ route('user.feedbacks.update', ['destination' => $destination, 'feedback' => $feedback]) }}"
                        class="d-inline" id="feedback-form-{{ $feedback->id }}">
                        @csrf
                        @method('PUT')

                        <div class="editable-feedback">
                            <!-- Feedback content, initially not editable -->
                            <div id="feedback-content-{{ $feedback->id }}" class="editable-content"
                                data-feedback-id="{{ $feedback->id }}">
                                {{ $feedback->comment }}
                            </div>

                            <!-- Hidden input to store the updated comment -->
                            <input type="hidden" name="comment" class="feedback-comment-input">
                        </div>

                        <!-- Buttons for Save and Cancel -->
                        <button type="button" class="btn btn-primary btn-sm" id="edit-btn-{{ $feedback->id }}"
                            onclick="toggleEdit({{ $feedback->id }})">Edit</button>
                        <button type="submit" class="btn btn-success btn-sm d-none"
                            id="save-btn-{{ $feedback->id }}">Save</button>
                        <button type="button" class="btn btn-danger btn-sm d-none" id="cancel-btn-{{ $feedback->id }}"
                            onclick="cancelEdit({{ $feedback->id }})">Cancel</button>
                    </form>
                @else
                    <p>{{ $feedback->comment }}</p>
                @endif
                @php
                    $userReaction = $feedback->reactions->where('user_id', auth()->id())->first()->reaction ?? null;
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
            </div>
        @endforeach
        <hr>
        <form action="{{ route('user.feedbacks.store', ['destination' => $destination->id]) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="feedback" class="form-label">Leave a Feedback</label>
                <textarea name="comment" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <div class="card-footer text-end">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
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
                                @if (auth()->user()->id === $video->user_id)
                                    <button type="button" class="btn btn-warning btn-sm" id="btn-edit"
                                        onclick="editVideo({{ $video->id }})">Edit</button>
                                @endif
                                <p class="card-text">
                                    <span class="video-description"
                                        id="video-description-{{ $video->id }}">{{ $video->description }}</span>
                                </p>
                                <a href="{{ $video->url }}" target="_blank" class="btn btn-link">Watch Video</a>

                                <!-- Copy Link Button -->
                                <button type="button" class="btn btn-primary "
                                    onclick="copyToClipboard('{{ $video->url }}')">
                                    Copy Link
                                </button>

                                @if (auth()->user()->id === $video->user_id)
                                    <form id="edit-video-form-{{ $video->id }}"
                                        action="{{ route('user.destinations.videos.update', ['destination' => $destination->id, 'video' => $video->id]) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="video_id" value="{{ $video->id }}">
                                        <div class="mb-3">
                                            <label for="video_title" class="form-label">Video Title</label>
                                            <input type="text" name="title" class="form-control"
                                                value="{{ $video->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="video_url" class="form-label">Video URL</label>
                                            <input type="url" name="url" class="form-control"
                                                value="{{ $video->url }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="video_description" class="form-label">Video Description</label>
                                            <textarea name="description" class="form-control" rows="2">{{ $video->description }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success">Save</button>
                                        <button type="button" class="btn btn-secondary" id="btn-cancel"
                                            onclick="cancelEditVideo({{ $video->id }})">Cancel</button>
                                    </form>
                                @endif
                            @else
                                <span class="badge bg-secondary">Under Review</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <form action="{{ route('user.destinations.videos.store', $destination->id) }}" method="POST">
            @csrf
            <h4>Add Videos</h4>
            <div id="video-container">
                <div class="video-group">
                    <div class="mb-3">
                        <label for="video_title[]" class="form-label">Video Title</label>
                        <input type="text" name="video_title[]" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="video_url[]" class="form-label">Video URL</label>
                        <input type="url" name="video_url[]" class="form-control" placeholder="https://example.com"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="video_description[]" class="form-label">Video Description</label>
                        <textarea name="video_description[]" class="form-control" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>



    <hr>



    <script>
        function copyToClipboard(url) {
            navigator.clipboard.writeText(url)
                .then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Copied!',
                        text: 'Link copied to clipboard!',
                    });
                })
                .catch(err => {
                    console.error('Failed to copy: ', err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Failed to copy link.',
                    });
                });
        }
    </script>


    <script>
        function editVideo(videoId) {
            document.getElementById('btn-edit').style.display = 'none';
            // Show the form and hide the static content
            document.getElementById('video-title-' + videoId).style.display = 'none';
            document.getElementById('video-description-' + videoId).style.display = 'none';
            document.getElementById('edit-video-form-' + videoId).style.display = 'block';
        }

        function cancelEditVideo(videoId) {
            console.log(videoId);

            document.getElementById('btn-edit').style.display = 'inline';

            // Hide the form and show the static content again
            document.getElementById('video-title-' + videoId).style.display = 'inline';
            document.getElementById('video-description-' + videoId).style.display = 'inline';
            document.getElementById('edit-video-form-' + videoId).style.display = 'none';
        }
    </script>


    </div>

    <script>
        // Toggle contenteditable mode and show/hide buttons
        function toggleEdit(feedbackId) {
            const feedbackContent = document.getElementById('feedback-content-' + feedbackId);
            const editBtn = document.getElementById('edit-btn-' + feedbackId);
            const saveBtn = document.getElementById('save-btn-' + feedbackId);
            const cancelBtn = document.getElementById('cancel-btn-' + feedbackId);
            const inputField = document.querySelector('#feedback-form-' + feedbackId + ' .feedback-comment-input');

            // Toggle the contenteditable state
            if (feedbackContent.contentEditable === "true") {
                feedbackContent.contentEditable = "false";
                inputField.value = feedbackContent.innerText.trim();
                editBtn.classList.remove('d-none');
                saveBtn.classList.add('d-none');
                cancelBtn.classList.add('d-none');
            } else {
                feedbackContent.contentEditable = "true";
                feedbackContent.focus();
                saveBtn.classList.remove('d-none');
                cancelBtn.classList.remove('d-none');
                editBtn.classList.add('d-none');
            }

            // Update the hidden input field with the new comment when editing
            feedbackContent.addEventListener('input', function() {
                inputField.value = feedbackContent.innerHTML.trim();
            });
        }

        // Cancel editing
        function cancelEdit(feedbackId) {
            const feedbackContent = document.getElementById('feedback-content-' + feedbackId);
            const editBtn = document.getElementById('edit-btn-' + feedbackId);
            const saveBtn = document.getElementById('save-btn-' + feedbackId);
            const cancelBtn = document.getElementById('cancel-btn-' + feedbackId);
            const inputField = document.querySelector('#feedback-form-' + feedbackId + ' .feedback-comment-input');

            // Revert to original text (without saving changes)
            feedbackContent.innerHTML = inputField.value;

            feedbackContent.contentEditable = "false";
            editBtn.classList.remove('d-none');
            saveBtn.classList.add('d-none');
            cancelBtn.classList.add('d-none');
        }
    </script>
@endsection
