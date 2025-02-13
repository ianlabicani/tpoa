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
                                <small class="text-muted float-end" id="time-{{ $feedback->id }}" 
                                    data-timestamp="{{ $feedback->created_at }}">
                                    {{ $feedback->created_at->diffForHumans() }}
                                </small>
                            </h5>
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

        <!-- Pagination Section -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <p class="text-muted">
                Showing {{ $feedbacks->firstItem() }} to {{ $feedbacks->lastItem() }} of {{ $feedbacks->total() }} feedbacks
            </p>
            <div class="d-flex justify-content-center">
                {{ $feedbacks->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- JavaScript for Dynamic Relative Time -->
    <script>
        dayjs.extend(window.dayjs_plugin_relativeTime);

        document.addEventListener('DOMContentLoaded', function () {
            const feedbackTimes = document.querySelectorAll('[id^="time-"]');

            feedbackTimes.forEach((element) => {
                const timestamp = element.getAttribute('data-timestamp');
                setInterval(() => {
                    element.textContent = dayjs(timestamp).fromNow();
                }, 60000); // Update every minute
            });
        });
    </script>

    <!-- Additional Styling -->
    <style>
        .pagination .page-item .page-link {
            color: #007bff;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 0 2px;
            transition: all 0.3s ease;
        }

        .pagination .page-item .page-link:hover {
            background-color: #007bff;
            color: #fff;
        }

        .pagination .page-item.active .page-link {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
        }
    </style>

@endsection
    