<style>
    button.active {

        color: white;
    }

    /* Icon style */
    i.fas {
        margin-right: 8px;
        /* Adds space between the icon and the text */
        color: #007bff;
        /* Optional color for icons */
    }

    /* Change the background color on hover */
</style>
<style>
    .reaction-button {
        border: none;
        background: none;
        font-size: 16px;
        color: #6a6a6a;
        display: flex;
        align-items: center;
        cursor: pointer;
        gap: 5px;
    }

    .reaction-button.active {
        font-weight: bold;
        color: #007bff;
    }

    .reaction-button i {
        font-size: 20px;
    }

    .reaction-button:hover {
        color: #0056b3;
    }
</style>

{{-- TODO:
    map
    how to get here?
    day and night pictures
--}}

@extends('user.shell')

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
                        // Check if latitude and longitude are provided
                        @if ($destination->latitude && $destination->longitude)
                            var latitude = {{ $destination->latitude }};
                            var longitude = {{ $destination->longitude }};
                        @else
                            var latitude = 18.3564; // Default latitude (example: Aparri, Cagayan, Philippines)
                            var longitude = 121.6402; // Default longitude
                        @endif

                        // Initialize the map
                        var map = L.map('map').setView([latitude, longitude], 13);

                        // Add multiple tile layers
                        var baseLayers = {
                            "OpenStreetMap": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; OpenStreetMap contributors'
                            }),
                            "Google Streets": L.tileLayer('https://mt1.google.com/vt/lyrs=r&x={x}&y={y}&z={z}', {
                                attribution: '© Google Maps'
                            }),
                            "Google Satellite": L.tileLayer('https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
                                attribution: '© Google Maps'
                            }),
                            "Dark Mode": L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}.png', {
                                attribution: '© Stadia Maps, © OpenMapTiles, © OpenStreetMap contributors'
                            })
                        };

                        // Add OpenStreetMap as the default tile layer
                        baseLayers["OpenStreetMap"].addTo(map);

                        // Add layer control to switch between layers
                        L.control.layers(baseLayers).addTo(map);

                        // Add the main destination marker with coordinates
                        L.marker([latitude, longitude]).addTo(map)
                            .bindPopup(`
                                <b>Destination: {{ $destination->name }}</b><br>
                                Latitude: ${latitude}<br>
                                Longitude: ${longitude}
                            `)
                            .openPopup();

                        // Add points of interest (POIs)
                        const pointsOfInterest = [{
                                lat: 18.35563019274085,
                                lng: 121.63384768213126,
                                name: "Aparri Beach",
                                description: "Famous for its natural beauty."
                            },
                            {
                                lat: 18.355379815926486,
                                lng: 121.64200090392804,
                                name: "St Peter Thelmo Parish",
                                description: "Historic church in Aparri."
                            },
                            {
                                lat: 18.362924430961094,
                                lng: 121.62882759800767,
                                name: "Port of Aparri",
                                description: "Old Port of Aparri."
                            }
                        ];

                        pointsOfInterest.forEach(poi => {
                            L.marker([poi.lat, poi.lng]).addTo(map)
                                .bindPopup(
                                    `<strong>${poi.name}</strong><br>${poi.description}<br>Latitude: ${poi.lat}<br>Longitude: ${poi.lng}`
                                );
                        });
                    };
                </script>


                <div class="container my-5">
                    <div class="row">
                        <div class="container my-5">
                            <div class="row">
                                <!-- Column 1: Carousel Section -->
                                <div class="col-md-6 mb-4">
                                    <!-- Day Images Carousel -->
                                    <div id="dayImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @forelse (json_decode($destination->day_images, true) ?? [] as $index => $dayImage)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $dayImage) }}" alt="Day Image"
                                                        class="d-block w-100 rounded" style="object-fit: cover;">
                                                </div>
                                            @empty
                                                <div class="carousel-item active text-center">
                                                    <p class="text-muted">No day images available.</p>
                                                </div>
                                            @endforelse
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#dayImagesCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#dayImagesCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>

                                    <!-- Night Images Carousel -->
                                    <div id="nightImagesCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @forelse (json_decode($destination->night_images, true) ?? [] as $index => $nightImage)
                                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                    <img src="{{ asset('storage/' . $nightImage) }}" alt="Night Image"
                                                        class="d-block w-100 rounded" style="object-fit: cover;">
                                                </div>
                                            @empty
                                                <div class="carousel-item active text-center">
                                                    <p class="text-muted">No night images available.</p>
                                                </div>
                                            @endforelse
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#nightImagesCarousel" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#nightImagesCarousel" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Column 2: Details Section -->

                                <div class="col-md-6">
                                    <!-- Grouped Details Card -->
                                    <div class="card shadow-sm border rounded">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4">Destination Details</h5>

                                            <!-- Location -->
                                            <div class="d-flex align-items-start mb-4">
                                                <i class="fas fa-map-marker-alt fa-lg text-primary me-3"></i>
                                                <div>
                                                    <strong>Location:</strong>
                                                    <div class="text-muted">{{ $destination->location ?? 'N/A' }}</div>
                                                </div>
                                            </div>

                                            <!-- Contact -->
                                            <div class="d-flex align-items-start mb-4">
                                                <i class="fas fa-phone-alt fa-lg text-success me-3"></i>
                                                <div>
                                                    <strong>Contact:</strong>
                                                    <div class="text-muted">{{ $destination->contact ?? 'N/A' }}</div>
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="d-flex align-items-start mb-4">
                                                <i class="fas fa-envelope fa-lg text-warning me-3"></i>
                                                <div>
                                                    <strong>Email:</strong>
                                                    <div class="text-muted">{{ $destination->email ?? 'N/A' }}</div>
                                                </div>
                                            </div>

                                            <!-- Entrance Fee -->
                                            <div class="d-flex align-items-start mb-4">
                                                <i class="fas fa-money-bill-wave fa-lg text-info me-3"></i>
                                                <div>
                                                    <strong>Entrance Fee:</strong>
                                                    <div class="text-muted">
                                                        {{ $destination->entrance_fee ? '₱' . number_format($destination->entrance_fee, 2) : 'Free' }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Availability -->
                                            <div class="d-flex align-items-start mb-4">
                                                <i class="fas fa-calendar-check fa-lg text-danger me-3"></i>
                                                <div>
                                                    <strong>Availability:</strong>
                                                    <div class="text-muted">
                                                        {{ $destination->availability ? 'Available' : 'Unavailable' }}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Events -->
                                            <div class="d-flex align-items-start mb-4">
                                                <i class="fas fa-calendar-day fa-lg text-secondary me-3"></i>
                                                <div>
                                                    <strong>Events:</strong>
                                                    <div class="text-muted">
                                                        {{ $destination->events ?? 'No events listed' }}</div>
                                                </div>
                                            </div>

                                            <!-- Social Media Links -->
                                            <div class="d-flex align-items-start mb-4">
                                                <i class="fas fa-share-alt fa-lg text-primary me-3"></i>
                                                <div>
                                                    <strong>Social Media Links:</strong>
                                                    <div class="text-muted">
                                                        {!! $destination->social_media ?? '<p>No links available at the moment.</p>' !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Services Offered -->
                                            <div class="d-flex align-items-start mb-4">
                                                <i class="fas fa-cogs fa-lg text-success me-3"></i>
                                                <div>
                                                    <strong>Services Offered:</strong>
                                                    <div class="text-muted">
                                                        {!! $destination->service_offer ?? '<p>No services available at the moment.</p>' !!}
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- How to Get There -->
                                            <div class="d-flex align-items-start">
                                                <i class="fas fa-road fa-lg text-warning me-3"></i>
                                                <div>
                                                    <strong>How to Get There:</strong>
                                                    <div class="text-muted">
                                                        {!! $destination->how_to_get_there ?? '<p>No instructions available at the moment.</p>' !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Column 1: Feedbacks -->
                            <div class="col-md-6">
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

                            <!-- Column 2: Related Videos -->
                            <div class="col-md-6">
                                <!-- related videos Card -->
                                <div class="card shadow-sm border rounded">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Related Videos </h5>
                                    </div>
                                    <div class="card-body">
                                        @if ($videos->isEmpty())
                                            <p class="text-muted">No videos available for this destination.</p>
                                        @else
                                            @foreach ($videos as $video)
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

                                                    <!-- Embed YouTube Video -->
                                                    <iframe width="560" height="315" src="{{ $embedUrl }}"
                                                        title="Video player" frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                        referrerpolicy="strict-origin-when-cross-origin"
                                                        allowfullscreen></iframe>
                                                @else
                                                    <!-- If it's not a YouTube link, just show the media link -->
                                                    <a href="{{ $video->url }}" target="_blank"
                                                        class="btn btn-outline-primary">Watch Video</a>
                                                @endif


                                                <div class="border-bottom pb-3 mb-3">
                                                    <h5 class="card-title">
                                                        <span class="video-title"
                                                            id="video-title-{{ $video->id }}">{{ $video->title }}</span>
                                                    </h5>

                                                    <p class="card-text">
                                                        <span class="video-description"
                                                            id="video-description-{{ $video->id }}">{{ $video->description }}</span>
                                                    </p>
                                                    <a href="{{ $video->url }}" target="_blank"
                                                        class="btn btn-link">Watch Video</a>
                                                </div>
                                            @endforeach
                                        @endif

                                        <form action="{{ route('user.destinations.videos.store', $destination->id) }}"
                                            method="POST">
                                            @csrf
                                            <h4>Add Video</h4>
                                            <div id="video-container">
                                                <div class="video-group">
                                                    <div class="mb-3">
                                                        <label for="video_title" class="form-label">Video Title</label>
                                                        <input type="text" name="video_title" class="form-control"
                                                            required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="video_url" class="form-label">Video URL or Embed
                                                            Code</label>
                                                        <input type="url" name="video_url" class="form-control"
                                                            placeholder="https://example.com" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="video_description" class="form-label">Video
                                                            Description</label>
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


                        <div class="card-footer text-end">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                        </div>
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
                                            // Update like and dislike counts
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
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            // Update like and dislike counts
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

                                // Apply active state
                                if (userReaction === "like") {
                                    likeButton.classList.add("active");
                                } else if (userReaction === "dislike") {
                                    dislikeButton.classList.add("active");
                                }
                            }
                        });
                    </script>
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
                                            // Update like and dislike counts
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
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            // Update like and dislike counts
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
                                likeButton.classList.remove("btn-primary", "btn-outline-primary");
                                dislikeButton.classList.remove("btn-danger", "btn-outline-danger");

                                // Apply active state
                                if (userReaction === "like") {
                                    likeButton.classList.add("btn-primary");
                                    dislikeButton.classList.add("btn-outline-danger");
                                } else if (userReaction === "dislike") {
                                    dislikeButton.classList.add("btn-danger");
                                    likeButton.classList.add("btn-outline-primary");
                                } else {
                                    likeButton.classList.add("btn-outline-primary");
                                    dislikeButton.classList.add("btn-outline-danger");
                                }
                            }
                        });
                    </script>
                @endsection
