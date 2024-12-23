@extends('guest.shell')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">All Videos</h1>

        @if ($videos->isEmpty())
            <p>No videos available at the moment.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($videos as $video)
                    <div class="card bg-white shadow-lg rounded-lg p-6 mb-6">
                        <h5 class="text-xl font-bold text-gray-800">{{ $video->title }}</h5>
                        <p class="text-gray-600 mt-2">{{ $video->description }}</p>
                        <a href="{{ $video->url }}" target="_blank"
                            class="text-blue-500 hover:text-blue-700 mt-4 inline-block">Watch Video</a>

                        <div class="mt-4">
                            <a href="{{ route('destinations.show', $video->destination->id) }}"
                                class="text-sm text-blue-600 hover:text-blue-800">
                                View related destination
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
