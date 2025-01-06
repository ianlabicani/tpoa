@extends('layouts.admin')

@section('content')

    <h1 class="mt-4">Feedbacks</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Feedbacks</li>
    </ol>
    <div class="container mt-4">

        <div class="row">
            @foreach ($feedbacks as $feedback)
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5>
                                {{ $feedback->user->name ?? 'Anonymous User' }}
                                <small class="text-muted float-end" id="time-{{ $feedback->id }}">
                                    {{ $feedback->created_at->diffForHumans() }}
                                </small>
                            </h5>
                            <!-- Display the destination name -->
                            @if ($feedback->destination)
                                <p class="mb-0"><strong>Destination:</strong> {{ $feedback->destination->name }}</p>
                            @endif
                        </div>
                        
                        <div class="card-body">
                            <p>{{ $feedback->comment }}</p>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span style="color: #6c757d;">👍 Likes:</span>
                                    <span id="like-count-{{ $feedback->id }}">
                                        {{ $feedback->reactions->where('reaction', 'like')->count() }}
                                    </span>
                                    <span style="margin-left: 15px; color: #6c757d;">👎 Dislikes:</span>
                                    <span id="dislike-count-{{ $feedback->id }}">
                                        {{ $feedback->reactions->where('reaction', 'dislike')->count() }}
                                    </span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $feedbacks->links() }} <!-- Pagination Links -->
        </div>
    </div>

<script>
    dayjs.extend(window.dayjs_plugin_relativeTime);

    document.addEventListener('DOMContentLoaded', function () {
        const feedbackTimes = document.querySelectorAll('[id^="time-"]'); // Select all time elements by ID prefix

        feedbackTimes.forEach((element) => {
            const feedbackId = element.id.split('-')[1];
            const timestamp = element.getAttribute('data-timestamp'); // Timestamp from data attribute
            
            setInterval(() => {
                element.textContent = dayjs(timestamp).fromNow(); // Update time dynamically
            }, 60000); // Update every minute
        });
    });
</script>

@endsection
