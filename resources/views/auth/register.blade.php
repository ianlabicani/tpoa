@extends('auth.shell')

@section('content')
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="row w-100">
            <div class="col-lg-6 col-md-8 col-12 mx-auto">
                <h2 class="text-center mb-4">Register</h2>

                <!-- Check for success message -->
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Registration Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}"
                            required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}"
                            required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                            required>
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    <a href="{{ route('login') }}">Login</a>
                </form>
            </div>
        </div>
    </div>
@endsection
