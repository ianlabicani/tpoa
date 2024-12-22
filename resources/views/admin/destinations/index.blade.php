@extends('admin.shell')

@section('content')
    <div class="container mt-4">
        <h1>Destinations</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Cover</th>
                    <th>Entrance Fee</th>
                    <th>Availability</th>
                    <th>Service Offer</th>
                    <th>Events</th>
                    <th>Social Media</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($destinations as $destination)
                    <tr>
                        <td>{{ $destination->id }}</td>
                        <td>{{ $destination->name }}</td>
                        <td>{{ $destination->location }}</td>
                        <td>{{ $destination->contact }}</td>
                        <td>{{ $destination->email }}</td>
                        <td>
                            @if ($destination->cover)
                                <img src="{{ asset('storage/' . $destination->cover) }}" alt="Cover" width="50">
                            @else
                                No Image
                            @endif
                        </td>
                        <td>{{ $destination->entrance_fee ? number_format($destination->entrance_fee, 2) : 'Free' }}</td>
                        <td>{{ $destination->availability ? 'Available' : 'Unavailable' }}</td>
                        <td>{{ $destination->service_offer }}</td>
                        <td>{{ $destination->events }}</td>
                        <td>
                            @if ($destination->social_media)
                                @php $socialMedia = json_decode($destination->social_media, true); @endphp
                                <ul>
                                    @foreach ($socialMedia as $platform => $link)
                                        <li><a href="{{ $link }}" target="_blank">{{ ucfirst($platform) }}</a></li>
                                    @endforeach
                                </ul>
                            @else
                                No Social Media
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.destinations.show', $destination->id) }}"
                                class="btn btn-sm btn-primary">View</a>
                            <a href="{{ route('admin.destinations.edit', $destination->id) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.destinations.destroy', $destination->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
