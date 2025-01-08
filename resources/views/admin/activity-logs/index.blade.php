@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Activity Logs</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Activity Logs</li>
</ol>
    <div class="container mt-4">
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Causer</th>
                        <th>Subject</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activityLogs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->description }}</td>
                            <td>
                                {{ $log->causer ? $log->causer->name : 'System' }}
                            </td>
                            <td>
                                @if ($log->subject)
                                    {{ class_basename($log->subject_type) }}: {{ $log->subject->id }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No activity logs available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {{ $activityLogs->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
