@extends('guest.shell')
@section('content')
    <style>
        /* Styling updates */
        .reaction-buttons .btn-link span {
            display: flex;
            align-items: center;
        }

        .reaction-buttons .btn-link i {
            margin-right: 5px;
        }

        .reaction-buttons .btn-link span {
            margin-right: 10px;
        }

        .share-section a {
            margin-right: 10px;
        }

        .share-section .ms-3 {
            margin-left: 10px;
        }

        .video-thumbnail {
            cursor: pointer;
            height: 260px;
            object-fit: cover;
        }

        .video-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
    </style>

    <section class="single-page-header"></section>
    <!-- Upload Video Button -->
    <div class="container mt-5">
        <h2>All Videos</h2>
        <div class="row">
            @if ($videos->isEmpty())
                <div class="col-12">
                    <p>No videos uploaded yet.</p>
                </div>
            @else
                @foreach ($videos as $video)
                    <div class="col-lg-4 col-md-6 col-sm-12 single-video mb-4">
                        <div class="card">
                            <!-- Video Thumbnail -->
                            @php
                                // Extract YouTube video ID
                                preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video->url, $matches);
                                $youtubeId = $matches[1] ?? '';
                                $thumbnailUrl = "https://img.youtube.com/vi/{$youtubeId}/hqdefault.jpg";
                            @endphp

                            <img src="{{ $thumbnailUrl }}" alt="Video Thumbnail" class="card-img-top video-thumbnail"
                                data-bs-toggle="modal" data-bs-target="#videoModal" data-video-url="{{ $video->url }}">

                            <div class="card-body">
                                <!-- Video Title -->
                                <a href="{{ route('destinations.show', ['destination' => $video->destination]) }}">
                                    <h3 class="video-title">{{ $video->title }}</h3>
                                    </a>
                                    <p class="text-muted">
                                    Uploaded by {{ $video->user_id }} on
                                    {{ $video->created_at->format('F d, Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

 

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Video Modal Logic
            const videoModal = document.getElementById('videoModal');
            const videoPlayer = document.getElementById('videoPlayer');

            videoModal.addEventListener('show.bs.modal', function(event) {
                const thumbnail = event.relatedTarget; // Element that triggered the modal
                const videoUrl = thumbnail.getAttribute('data-video-url'); // Get video URL from thumbnail
                videoPlayer.src = videoUrl.replace('watch?v=', 'embed/') + "?autoplay=1";
            });

            videoModal.addEventListener('hide.bs.modal', function() {
                videoPlayer.src = ''; // Stop video playback on modal close
            });
        });
    </script>
@endsection
