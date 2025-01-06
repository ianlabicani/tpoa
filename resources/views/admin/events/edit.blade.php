@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Edit Event</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.events.index') }}">Events</a></li>
    <li class="breadcrumb-item active">Edit Event</li>
</ol>

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
        @if ($event->image)
            <div class="mt-2">
                <img src="{{ Storage::url($event->image) }}" alt="Event Image" width="100">
            </div>
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Update Event</button>
</form>
@endsection
