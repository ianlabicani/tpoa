@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">Videos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Manage Videos</li>
    </ol>
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif


    @if ($videos->isEmpty())
        <div class="text-center">
            <p class="text-muted">No videos pending review.</p>
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($videos as $video)
                <div class="col">
                    <div class="card h-100 border-light shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-dark text-truncate">
                                <a href="{{ route('admin.destinations.show', ['destination' => $video->destination]) }}"
                                    class="text-decoration-none">
                                    {{ $video->title }}
                                </a>
                            </h5>
                            <p class="card-text text-muted text-truncate mb-3">{{ $video->description }}</p>
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
                                <iframe width="100%" height="315" src="{{ $embedUrl }}" title="Video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            @else
                                <!-- If it's not a YouTube link, just show the media link -->
                                <a href="{{ $video->url }}" target="_blank" class="btn btn-outline-primary">Watch
                                    Video</a>
                            @endif

                            @if (!$video->isReviewed)
                                <form action="{{ route('admin.videos.review', $video->id) }}" method="POST" class="mt-3">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm w-100">Approve</button>
                                </form>
                            @else
                                <div class="mt-3 text-center">
                                    <span class="badge bg-success">Reviewed</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
