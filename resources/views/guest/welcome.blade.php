@extends('guest.shell')


@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800">Welcome to Our Destinations</h1>
            <p class="text-xl text-gray-600 mt-4">Explore exciting destinations, watch related videos, and read reviews from
                other visitors!</p>
        </div>

        <!-- Key Features Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="feature-card bg-white shadow-lg rounded-lg p-6 text-center">
                <h3 class="text-2xl font-semibold text-gray-800">Discover New Destinations</h3>
                <p class="text-gray-600 mt-4">Browse through various destinations, view their details, and find the perfect
                    spot for your next adventure!</p>
                <a href="{{ route('destinations.index') }}"
                    class="text-blue-500 hover:text-blue-700 mt-4 inline-block">Explore Destinations</a>
            </div>

            <div class="feature-card bg-white shadow-lg rounded-lg p-6 text-center">
                <h3 class="text-2xl font-semibold text-gray-800">Watch Destination Videos</h3>
                <p class="text-gray-600 mt-4">Watch engaging videos related to destinations, giving you a sneak peek into
                    what awaits you!</p>
                <a href="{{ route('destinations.index') }}"
                    class="text-blue-500 hover:text-blue-700 mt-4 inline-block">Browse Videos</a>
            </div>

            <div class="feature-card bg-white shadow-lg rounded-lg p-6 text-center">
                <h3 class="text-2xl font-semibold text-gray-800">Read Visitor Feedback</h3>
                <p class="text-gray-600 mt-4">Learn from the experiences of others through their reviews and feedback about
                    each destination.</p>
                <a href="{{ route('destinations.index') }}" class="text-blue-500 hover:text-blue-700 mt-4 inline-block">Read
                    Feedback</a>
            </div>
        </div>

        <!-- Call to Action Section -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Get Started with Your Next Adventure!</h2>
            <p class="text-lg text-gray-600 mb-4">Browse destinations, check out videos, and make your next trip
                unforgettable.</p>
            <a href="{{ route('destinations.index') }}"
                class="bg-blue-500 text-white px-6 py-3 rounded-full text-xl hover:bg-blue-600 transition duration-300">Start
                Exploring</a>
        </div>
    </div>
@endsection
