@extends('guest.shell')
@section('content')
    <style>
        /* Ensure reaction button spacing is maintained */
        .reaction-buttons .btn-link span {
            display: flex;
            align-items: center;
        }

        .reaction-buttons .btn-link i {
            margin-right: 5px;
            /* Icon and count spacing */
        }

        .reaction-buttons .btn-link span {
            margin-right: 10px;
            /* Space after the count */
        }

        /* Share icons and their spacing */
        .share-section a {
            margin-right: 10px;
            /* Space between share icons */
        }

        /* Space between share icons and the 'Shares' text */
        .share-section .ms-3 {
            margin-left: 10px;
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
                            <!-- Video Embed -->
                            <iframe class="card-img-top" width="100%" height="260" src="{{ $video->url }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>

                            <div class="card-body">
                                <!-- Video Title -->
                                <a href="{{ route('destinations.show', ['destination' => $video->destination]) }}">
                                    <h3 class="video-title">{{ $video->title }}</h3>
                                </a>
                                <p class="text-muted">
                                    Uploaded by {{ $video->user_id }} on
                                    {{ $video->created_at->format('F d, Y') }}
                                </p>

                                <!-- Reaction Section -->
                                {{-- <div class="reaction-buttons d-flex align-items-center">
                                    <!-- Like Button -->
                                    <form action="{{ route('reactions.store') }}" method="POST" class="me-3">
                                        @csrf
                                        <input type="hidden" name="video_id" value="{{ $video->id }}">
                                        <input type="hidden" name="type" value="like">

                                        @php
                                            $hasLiked = $video->reactions
                                                ->where('type', 'like')
                                                ->where(
                                                    fn($q) => $q->guest_ip == request()->ip() ||
                                                        $q->user_id == auth()->id(),
                                                )
                                                ->isNotEmpty();
                                        @endphp

                                        <button type="submit" class="btn btn-link p-0 text-dark"
                                            @if ($hasLiked) disabled @endif>
                                            <i class="fas fa-thumbs-up me-2"></i>
                                            <span>{{ $video->reactions->where('type', 'like')->count() }}</span>
                                        </button>
                                    </form>

                                    <!-- Dislike Button -->
                                    <form action="{{ route('reactions.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="video_id" value="{{ $video->id }}">
                                        <input type="hidden" name="type" value="dislike">

                                        @php
                                            $hasDisliked = $video->reactions
                                                ->where('type', 'dislike')
                                                ->where(
                                                    fn($q) => $q->guest_ip == request()->ip() ||
                                                        $q->user_id == auth()->id(),
                                                )
                                                ->isNotEmpty();
                                        @endphp

                                        <button type="submit" class="btn btn-link p-0 text-dark"
                                            @if ($hasDisliked) disabled @endif>
                                            <i class="fas fa-thumbs-down me-2"></i>
                                            <span>{{ $video->reactions->where('type', 'dislike')->count() }}</span>
                                        </button>
                                    </form>
                                </div> --}}
                                <!-- Share Section -->
                                <div class="share-section mt-3 d-flex align-items-center">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('destinations.show', ['destination' => $video->destination])) }}"
                                        target="_blank" class="text-dark me-3">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>

                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('destinations.show', ['destination' => $video->destination])) }}&text={{ urlencode($video->title) }}"
                                        target="_blank" class="text-dark me-3">
                                        <i class="fab fa-twitter"></i>
                                    </a>

                                    <a href="https://www.instagram.com/?url={{ urlencode(route('destinations.show', ['destination' => $video->destination])) }}"
                                        target="_blank" class="text-dark me-3">
                                        <i class="fab fa-instagram"></i>
                                    </a>

                                    <button class="btn btn-link p-0 text-dark copy-link-btn"
                                        data-link="{{ route('destinations.show', ['destination' => $video->destination]) }}">
                                        <i class="fas fa-link"></i>
                                    </button>

                                    <span class="ms-3">
                                        <strong>{{ optional($video->shares)->count() }} Shares</strong>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- JavaScript for Copy Link -->
    <script>
        document.querySelectorAll('.copy-link-btn').forEach(button => {
            button.addEventListener('click', function() {
                const link = this.getAttribute('data-link');
                navigator.clipboard.writeText(link).then(() => {
                    alert('Link copied to clipboard!');
                });
            });
        });
    </script>


@endsection
