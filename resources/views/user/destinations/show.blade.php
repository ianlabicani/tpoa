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
                                action="{{ route('user.feedback.update', ['destination' => $destination, 'feedback' => $feedback]) }}"
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
                <a href="{{ route('user.destinations.index') }}" class="btn btn-secondary">Back</a>
            </div>
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
    </script>
@endsection
