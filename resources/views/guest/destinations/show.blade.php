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
                        <p>{{ $feedback->comment }}</p>
                        <hr>
                    </div>
                    <p>Likes: {{ $destination->like_count ?? 0 }}</p>
                    <p>Dislikes: {{ $destination->dislike_count ?? 0 }}</p>
                @endforeach
            </div>
            <div class="card-footer text-end">
                <p id="share-count" class="mb-4">Shares: <span id="share-count-value">{{ $destination->share_count }}</span>
                </p>

                <!-- Share Button -->
                <button type="button" class="btn btn-primary" id="share-button">
                    Share
                </button>

                <!-- Hidden Text Area for Copying -->
                <textarea id="share-text" style="position: absolute; left: -9999px;">
    {{ route('destinations.show', ['destination' => $destination->id]) }}
</textarea>

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
                                <!-- Copy Link Button -->
                                <button type="button" class="btn btn-primary "
                                    onclick="copyToClipboard('{{ $video->url }}')">
                                    Copy Link
                                </button>
                            @else
                                <span class="badge bg-secondary">Under Review</span>
                            @endif
                        </div>
                    </div>

                    <!-- Pagination links -->
                    <div class="pagination">
                        {{ $destinations->links() }}
                    </div>
                @endforeach
            @endif
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

    </div>
@endsection
