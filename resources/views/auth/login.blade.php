@extends('auth.shell')

@section('content')
    <div class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="container">

           
            <div class="row justify-content-center">
                
                <div class="col-lg-4 col-md-6 col-sm-8 col-12 bg-white p-4 rounded shadow-sm"
                    style="max-height: 90vh; overflow: auto;">

                    <!-- Success Message -->
                    @if (session('status'))
                        <div class="alert alert-success mb-4 text-center">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="navbar-brand text-dark text-center " href="/">
                        <h1 class="m-0">TPOA</h1>
                    </a>
                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">{{ __('Email') }}</label>
                            <input id="email" type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required autofocus autocomplete="username">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                            <input id="password" type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required
                                autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3 form-check">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label">
                                {{ __('Remember me') }}
                            </label>
                        </div>

                        <!-- Submit and Links -->
                        <div class="d-grid gap-3 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Log in') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="text-decoration-none small text-center" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>

                        <p class="text-center mt-3 small">
                            Don't have an account? <a href="{{ route('register') }}" class="fw-bold">Sign Up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Prevent scrolling */
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        .container {
            max-height: 90vh; /* Restrict container height */
            overflow: auto; /* Allow inner scroll if necessary */
        }

        .col-lg-4 {
            max-width: 400px; /* Restrict form width */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .col-lg-4 {
                max-width: 90%; /* Use 90% of the screen width */
            }

            .form-control {
                font-size: 0.9rem;
            }

            button {
                font-size: 0.9rem;
            }
        }
    </style>
@endsection
