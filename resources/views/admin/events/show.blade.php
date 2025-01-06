@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Events</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Events</li>
</ol>


<h1>{{ $event->name }}</h1>

<p><strong>Description:</strong> {{ $event->description }}</p>
<p><strong>Start Date:</strong> {{ $event->start_date }}</p>
<p><strong>End Date:</strong> {{ $event->end_date }}</p>

@if ($event->image)
    <img src="{{ Storage::url($event->image) }}" alt="Event Image" width="300">
@endif
@endsection


