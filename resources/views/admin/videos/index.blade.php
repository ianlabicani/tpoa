@extends('admin.shell')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="mb-4">Videos</h1>

    @if ($videos->isEmpty())
        <p>No videos pending review.</p>
    @else
        <div class="row">
            @foreach ($videos as $video)
                <div class="col-md-4 mb-4">
                    <div class="card {{ $video->isReviewed ? 'bg-success' : 'bg-warning' }} text-white">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('admin.destinations.show', ['destination' => $video->destination]) }}"
                                    class="text-white">
                                    {{ $video->title }}
                                </a>
                            </h5>
                            <p class="card-text">{{ $video->description }}</p>
                            <a href="{{ $video->url }}" target="_blank" class="btn btn-light">Watch Video and Review</a>

                            <div class="mt-3">
                                @if (!$video->isReviewed)
                                    <form action="{{ route('admin.videos.review', $video->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                                    </form>
                                @else
                                    <span class="badge badge-light">Reviewed</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
