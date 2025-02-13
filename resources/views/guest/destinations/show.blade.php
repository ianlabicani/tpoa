@extends('Guest.shell')

@section('content')


    <div class="container mt-4">
        <!-- Destination Section -->
        <div class="card shadow-sm p-4">
            <div class="row">
                <div class="container my-5">
                    <div class="row">
                        <!-- Column 1: Map -->
                        <div class="col-md-6">


                            <h3 class="mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>{{ $destination->name }}
                            </h3>
                            <p><strong>Location:</strong> {{ $destination->location ?? 'Not specified' }}</p>
                            <p><strong>Contact:</strong> {{ $destination->contact ?? 'Not specified' }}</p>
                            <p><strong>Email:</strong> {{ $destination->email ?? 'Not specified' }}</p>
                            <p><strong>Entrance Fee:</strong>
                                {{ $destination->entrance_fee ? '₱' . number_format($destination->entrance_fee, 2) : 'Not specified' }}
                            </p>
                            <p><strong>Availability:</strong> {{ $destination->availability ? 'Available' : 'Unavailable' }}
                            </p>
                            <p><strong>How to Get There:</strong></p>
                            <div>{!! $destination->how_to_get_there ?? 'No information available' !!}</div>
                            <p><strong>Description:</strong> {{ $destination->description ?? 'Not provided' }}</p>
                            <p><strong>History:</strong> {{ $destination->history ?? 'Not provided' }}</p>
                            <p><strong>Image Source:</strong> {{ $destination->image_source ?? 'Not provided' }}</p> 
                            <p><strong>Social Media:</strong></p>
                            <div>{!! $destination->description ?? 'No information available' !!}</div>
                            <p><strong>Service Offer:</strong></p>
                            <div>{!! $destination->service_offer ?? 'No information available' !!}</div>
                        </div>


                        <!-- Column 2: Destination Details -->
                        <div class="col-md-6">
                            <div class="map-container mb-4">
                                <div id="map" class="rounded" style="height: 500px; width: 100%;"></div>
                            </div>

                            
        <div class="my-5">
            <h4 class="mb-3 text-center">Service Offer Images</h4>
            @php
                $serviceOfferImages = json_decode($destination->service_offer_image, true) ?? [];
            @endphp
            @if (count($serviceOfferImages) > 0)
                <div id="serviceOfferCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($serviceOfferImages as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image) }}" alt="Service Offer Image"
                                    class="d-block w-100 rounded" style="height: 400px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#serviceOfferCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#serviceOfferCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @else
                <p class="text-muted text-center">No images available.</p>
            @endif
        </div>

        <div class="my-5">
            <h4 class="mb-3 text-center">Day Images</h4>
            <div id="dayImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @forelse (json_decode($destination->day_images, true) ?? [] as $index => $dayImage)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $dayImage) }}" alt="Day Image" class="d-block w-100 rounded"
                                style="height: 400px; object-fit: cover;">
                        </div>
                    @empty
                        <p class="text-muted text-center">No day images available.</p>
                    @endforelse
                </div>
                @if (count(json_decode($destination->day_images, true) ?? []) > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#dayImagesCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#dayImagesCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        </div>

        <div class="my-5">
            <h4 class="mb-3 text-center">Night Images</h4>
            <div id="nightImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @forelse (json_decode($destination->night_images, true) ?? [] as $index => $nightImage)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $nightImage) }}" alt="Night Image"
                                class="d-block w-100 rounded" style="height: 400px; object-fit: cover;">
                        </div>
                    @empty
                        <p class="text-muted text-center">No night images available.</p>
                    @endforelse
                </div>
                @if (count(json_decode($destination->night_images, true) ?? []) > 1)
                    <button class="carousel-control-prev" type="button" data-bs-target="#nightImagesCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#nightImagesCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                @endif
            </div>
        </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="container my-5">
        <div class="card shadow-sm p-4">
            <div class="row">

                <!-- Feedback Section -->
                <div class="mt-4">
                    <h4>Feedbacks</h4>
                    @forelse ($feedbacks as $feedback)
                        <div class="card mb-3 p-3">
                            <p><strong>{{ $feedback->user->name ?? 'Anonymous' }}:</strong> {{ $feedback->comment }}</p>

                            <!-- Likes and Dislikes with Icons -->
                            <div class="d-flex justify-content-start">
                                <span class="mr-3">
                                    <i class="fas fa-thumbs-up"></i>
                                    <strong>{{ $feedback->reactions->where('reaction', 'like')->count() }}</strong>
                                </span>
                                <span>
                                    <i class="fas fa-thumbs-down"></i>
                                    <strong>{{ $feedback->reactions->where('reaction', 'dislike')->count() }}</strong>
                                </span>
                            </div>
                        </div>
                    @empty
                        <p>No feedbacks yet.</p>
                    @endforelse
                </div>

                <!-- Column 2: Map and Related Videos -->
                <div class="col-md-6">
                    <!-- Map -->
                    <div id="map" style="height: 300px;" class="mb-4"></div>

                    <!-- Related Videos -->
                    <h4>Related Videos</h4>
                    @if ($videos->isEmpty())
                        <p>No videos available for this destination.</p>
                    @else
                        <div class="row">
                            @foreach ($videos as $video)
                                <div class="col-md-12 mb-3">
                                  
                                            <!-- Video Title -->
                                            <h5 class="card-title">{{ $video->title }}</h5>
                                            <!-- Embed YouTube Video -->
                                            @if (strpos($video->url, 'youtube.com') !== false || strpos($video->url, 'youtu.be') !== false)
                                                @php
                                                    if (strpos($video->url, 'youtu.be') !== false) {
                                                        $videoId = basename($video->url);
                                                        $embedUrl = 'https://www.youtube.com/embed/' . $videoId;
                                                    } elseif (strpos($video->url, 'youtube.com') !== false) {
                                                        parse_str(parse_url($video->url, PHP_URL_QUERY), $params);
                                                        $embedUrl = 'https://www.youtube.com/embed/' . $params['v'];
                                                    }
                                                @endphp
                                                <iframe width="100%" height="200" src="{{ $embedUrl }}"
                                                    frameborder="0" allowfullscreen></iframe>
                                            @else
                                                <a href="{{ $video->url }}" target="_blank"
                                                    class="btn btn-outline-primary">Watch
                                                    Video</a>
                                            @endif
                                            <!-- Video Description -->
                                            <p class="mt-2">{{ $video->description }}</p>
                                    
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const latitude = {{ $destination->latitude }};
                const longitude = {{ $destination->longitude }};
                const locationName = "{{ $destination->name ?? 'Unnamed Location' }}";

                const map = L.map('map').setView([latitude, longitude], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                L.marker([latitude, longitude]).addTo(map)
                    .bindPopup(`<b>${locationName}</b>`)
                    .openPopup();
            });
        </script>
    @endsection
