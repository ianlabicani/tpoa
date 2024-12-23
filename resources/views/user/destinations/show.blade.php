@extends('user.shell')

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
                                <button type="button" class="btn btn-danger btn-sm d-none"
                                    id="cancel-btn-{{ $feedback->id }}"
                                    onclick="cancelEdit({{ $feedback->id }})">Cancel</button>
                            </form>
                        @else
                            <p>{{ $feedback->comment }}</p>
                        @endif

                        <hr>
                    </div>
                @endforeach
            </div>
            <div class="card-footer text-end">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
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
