@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Edit Event</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
    <li class="breadcrumb-item active">Edit Event</li>
</ol>

<!-- Card to contain the form -->
<div class="card">
    <div class="card-header">
        <h5>Edit Event Details</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Event Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $event->name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description" rows="4">{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="history">History</label>
                <textarea name="history" class="form-control" id="history" rows="4">{{ old('history', $event->history) }}</textarea>
            </div>

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" id="start_date" value="{{ old('start_date', $event->start_date) }}" required>
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" name="end_date" class="form-control" id="end_date" value="{{ old('end_date', $event->end_date) }}" required>
            </div>

            <div class="form-group">
                <label for="image">Event Image</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>

            <div class="form-group">
                <label for="source">Source</label>
                <input type="text" name="source" class="form-control" id="source" value="{{ old('source', $event->source) }}" required>
            </div>

            <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.events.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-success">Update Event</button>
            </div>
        </form>
    </div>
</div>

@endsection
