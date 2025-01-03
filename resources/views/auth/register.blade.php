@extends('auth.shell')

@section('content')
    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8 col-12 bg-white p-4 rounded shadow-sm" style="margin: 2rem 0;">
                    <h1 class="text-center mb-3" style="font-weight: bold; font-size: 2rem;">Sign Up</h1>
                   

                    <!-- Check for success message -->
                    @if (session('success'))
                        <div class="alert alert-success text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="name" class="fw-bold">Full Name</label>
                            <input type="text" name="name" class="form-control p-3" id="name"
                                placeholder="Enter your full name" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email" class="fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control p-3" id="email"
                                placeholder="Enter your email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="fw-bold">Password</label>
                            <input type="password" name="password" class="form-control p-3" id="password"
                                placeholder="Create a password" required>
                            @error('password')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="fw-bold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control p-3"
                                id="password_confirmation" placeholder="Re-enter your password" required>
                            @error('password_confirmation')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary btn-lg" style="font-size: 1.1rem;">Sign Up</button>
                        </div>
                        <p class="text-center text-muted small">
                            Already have an account? <a href="{{ route('login') }}" class="fw-bold">Log In</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Ensure the body takes up the full screen */
        body, html {
            height: 100%;
            margin: 0;
        }

        /* Add vertical margins */
        .container {
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            h1 {
                font-size: 1.8rem;
            }

            .form-control {
                font-size: 0.9rem;
            }

            .btn-lg {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 1rem;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection
