@extends('layouts.admin')

@section('content')
    <h1 class="mt-4">Events</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Create Events</li>
    </ol>

    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <!-- Main Content Area -->
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>Create New Event</h3>
                        <a href=" {{ route('admin.events.index') }} " class="btn btn-secondary btn-sm">Back to List</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Event Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" id="description" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="history">History</label>
                                <textarea name="history" class="form-control" id="history" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" class="form-control" id="start_date" required>
                            </div>

                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" class="form-control" id="end_date" required>
                            </div>

                            <div class="form-group">
                                <label for="image">Event Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>


                            <div class="form-group">
                                <label for="source">Source</label>
                                <input type="text" name="source" id="source" class="form-control"
                                    placeholder="Enter the image source">
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('admin.events.index') }}" class="btn btn-secondary me-2">Cancel</a>
                                <button type="submit" class="btn btn-success">Create Events</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
