@extends('layouts.admin')

@section('content')
<h1 class="mt-4">Activity Logs</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Activity Logs</li>
</ol>

@endsection