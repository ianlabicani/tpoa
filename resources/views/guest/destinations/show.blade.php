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

@extends('guest.shell')

@section('content')
    <div class="container mt-4 p-4">
        <div>
            <div class="text-center">
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
                        <strong>Events:</strong> {{ $destination->events ?? 'No events listed' }}
                    </div>
                    <div class="col-md-12">
                        <strong>Social Media Links:</strong>
                        {!! $destination->social_media ?? '<p>No links available at the moment.</p>' !!}
                    </div>
                    <div class="col-md-12">
                        <strong>Services Offered:</strong>
                        {!! $destination->service_offer ?? '<p>No services available at the moment.</p>' !!}
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

            <div class=" d-flex flex-column align-items-center">
                <div class="my-4" style="width: 700px; margin-bottom: 50px;"> <!-- Reduced margin-bottom -->
                    <h4 class="mb-3 text-center">Day Images</h4>
                    <div id="dayImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @forelse (json_decode($destination->day_images, true) ?? [] as $index => $dayImage)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $dayImage) }}" alt="Day Image"
                                        class="d-block w-100 rounded" style="object-fit: cover;" data-bs-toggle="modal"
                                        data-bs-target="#imageModal" data-bs-src="{{ asset('storage/' . $dayImage) }}">
                                </div>
                            @empty
                                <div class="carousel-item active text-center">
                                    <p class="text-muted">No day images available.</p>
                                </div>
                            @endforelse
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#dayImagesCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#dayImagesCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <div class="my-4" style="width: 700px; margin-top: 100px;"> <!-- Added margin-top -->
                    <h4 class="mb-3 text-center">Night Images</h4>
                    <div id="nightImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @forelse (json_decode($destination->night_images, true) ?? [] as $index => $nightImage)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $nightImage) }}" alt="Night Image"
                                        class="d-block w-100 rounded" style="width: 80%; height: 300px; object-fit: cover;"
                                        data-bs-toggle="modal" data-bs-target="#imageModal"
                                        data-bs-src="{{ asset('storage/' . $nightImage) }}">
                                </div>
                            @empty
                                <div class="carousel-item active text-center">
                                    <p class="text-muted">No night images available.</p>
                                </div>
                            @endforelse
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#nightImagesCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#nightImagesCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>


            <!-- Modal for Full Image View -->
            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img id="modalImage" src="" class="img-fluid" alt="Full Image" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Displaying feedbacks -->
            @foreach ($feedbacks as $feedback)
                <div>
                    <strong>{{ $feedback->user->name }}</strong> ({{ $feedback->created_at->format('M d, Y') }})

                    <!-- Feedback content editable if current user owns it -->
                    @if (auth()->check() && auth()->user()->id === $feedback->user_id)
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
                            <button type="button" class="btn btn-danger btn-sm d-none"
                                id="cancel-btn-{{ $feedback->id }}"
                                onclick="cancelEdit({{ $feedback->id }})">Cancel</button>
                        </form>
                    @else
                        <p>{{ $feedback->comment }}</p>
                    @endif
                    @php
                        $userReaction = $feedback->reactions->where('user_id', auth()->id())->first()->reaction ?? null;
                    @endphp


                    <div style="display: flex; align-items: center; gap: 20px;">
                        <p>
                            <span style="font-weight: bold;">👍 Likes:</span>
                            <span id="like-count-{{ $feedback->id }}">
                                {{ $feedback->reactions->where('reaction', 'like')->count() }}
                            </span>
                        </p>
                        <p>
                            <span style="font-weight: bold;">👎 Dislikes:</span>
                            <span id="dislike-count-{{ $feedback->id }}">
                                {{ $feedback->reactions->where('reaction', 'dislike')->count() }}
                            </span>
                        </p>
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
                                    <span class="video-title"
                                        id="video-title-{{ $video->id }}">{{ $video->title }}</span>
                                </h5>

                                @if ($video->isReviewed)
                                    @if (auth()->check() && auth()->user()->id === $video->user_id)
                                        <!-- The authenticated user is the uploader -->
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

                                    @if (auth()->check() && auth()->user()->id === $video->user_id)
                                        <!-- The authenticated user is the uploader -->


                                        <form id="edit-video-form-{{ $video->id }}"
                                            action="{{ route('destinations.videos.update', ['destination' => $destination->id, 'video' => $video->id]) }}"
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
                                                <label for="video_description" class="form-label">Video
                                                    Description</label>
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


        </div>




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

        // Update the modal image source when an image is clicked
        var modal = document.getElementById('imageModal');
        var modalImage = document.getElementById('modalImage');

        modal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var imageSrc = button.getAttribute('data-bs-src');
            modalImage.src = imageSrc;
        });
    </script>
@endsection
