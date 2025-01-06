@extends('guest.shell')
@section('content')
<h1 class="mt-4">Events</h1>


<h1>{{ $event->name }}</h1>

<p><strong>Description:</strong> {{ $event->description }}</p>
<p><strong>Start Date:</strong> {{ $event->start_date }}</p>
<p><strong>End Date:</strong> {{ $event->end_date }}</p>

@if ($event->image)
    <img src="{{ Storage::url($event->image) }}" alt="Event Image" width="300">
@endif
@endsection
