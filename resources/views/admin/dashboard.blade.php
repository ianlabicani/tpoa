@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>

    <!-- Analytics Cards - 3 Columns -->
    <div class="row">
        <!-- Total Visitors Card -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body bg-light text-dark rounded">
                    <div class="d-flex align-items-center">
                        <div class="icon-container me-3">
                            <i class="fas fa-users fa-3x text-primary"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-0">Total Visitors</h5>
                            <p class="fs-3 fw-bold mb-0">{{ $totalVisitors ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Videos Card -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body bg-light text-dark rounded">
                    <h5 class="card-title mb-3">Total Videos</h5>
                    <ul class="list-unstyled">
                        @foreach ($videoCounts as $videoCount)
                            <li>
                                <i class="fas fa-video me-2 text-info"></i>
                                Destination 
                                <strong>{{ $videoCount->destination->name ?? 'Unknown' }}</strong>: 
                                <strong>{{ $videoCount->total_videos }}</strong> Videos
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Reaction Analytics Card -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body bg-light text-dark rounded">
                    <h5 class="card-title mb-3">Reactions</h5>
                    <ul class="list-unstyled">
                        <li>
                            <strong>Likes: </strong>{{ $reactionData[0] ?? 0 }}
                        </li>
                        <li>
                            <strong>Dislikes: </strong>{{ $reactionData[1] ?? 0 }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Graph Section - 3 Columns -->
    <div class="row">
        <!-- Visitor Analytics Graph -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white">
                    Visitor Analytics
                </div>
                <div class="card-body">
                    <canvas id="visitorChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Video Analytics Graph -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-info text-white">
                    Video Analytics
                </div>
                <div class="card-body">
                    <canvas id="videoChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Reaction Analytics Graph -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-warning text-white">
                    Reaction Analytics
                </div>
                <div class="card-body">
                    <canvas id="reactionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Visitor Analytics Chart
            const visitorCtx = document.getElementById('visitorChart').getContext('2d');
            new Chart(visitorCtx, {
                type: 'line',
                data: {
                    labels: @json($visitorDates),
                    datasets: [{
                        label: 'Visitors',
                        data: @json($visitorCounts),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.raw} visitors`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: { 
                            title: { display: true, text: 'Date', color: '#666' },
                            grid: { color: 'rgba(200, 200, 200, 0.2)' }
                        },
                        y: { 
                            title: { display: true, text: 'Visitors', color: '#666' },
                            beginAtZero: true,
                            grid: { color: 'rgba(200, 200, 200, 0.2)' }
                        }
                    }
                }
            });

            // Video Analytics Chart
            const videoCtx = document.getElementById('videoChart').getContext('2d');
            new Chart(videoCtx, {
                type: 'bar',
                data: {
                    labels: @json($videoLabels),
                    datasets: [{
                        label: 'Videos',
                        data: @json($videoData),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.raw} videos`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: { 
                            title: { display: true, text: 'Destination', color: '#666' },
                            grid: { color: 'rgba(200, 200, 200, 0.2)' }
                        },
                        y: { 
                            title: { display: true, text: 'Count', color: '#666' },
                            beginAtZero: true,
                            grid: { color: 'rgba(200, 200, 200, 0.2)' }
                        }
                    }
                }
            });

            // Reaction Analytics Chart
            const reactionCtx = document.getElementById('reactionChart').getContext('2d');
            new Chart(reactionCtx, {
                type: 'pie',
                data: {
                    labels: @json($reactionLabels),
                    datasets: [{
                        data: @json($reactionData),
                        backgroundColor: ['rgba(54, 162, 235, 0.5)', 'rgba(255, 99, 132, 0.5)'],  // Blue for like, Red for dislike
                        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)'],  // Blue for like, Red for dislike
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.raw} reactions`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
