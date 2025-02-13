<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">

            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <hr>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseHotels"
                aria-expanded="false" aria-controls="collapseHotels">
                <div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
                Hotels
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseHotels" aria-labelledby="headingHotels"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('admin.hotels.index') }}">View Hotels</a>
                    <a class="nav-link" href="{{ route('admin.hotels.create') }}">Add Hotels</a>
                </nav>
            </div>

            <!-- Destinations Section -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                data-bs-target="#collapseDestinations" aria-expanded="false" aria-controls="collapseDestinations">
                <div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
                Destinations
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseDestinations" aria-labelledby="headingDestinations"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('admin.destinations.index') }}">View Destinations</a>
                    <a class="nav-link" href="{{ route('admin.destinations.create') }}">Add Destinations</a>
                </nav>
            </div>

            <!-- Videos Section -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseVideos"
                aria-expanded="false" aria-controls="collapseVideos">
                <div class="sb-nav-link-icon"><i class="fas fa-video"></i></div>
                Videos
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseVideos" aria-labelledby="headingVideos"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('admin.videos.index') }}">Manage Videos</a>
                </nav>
            </div>

            <!-- Events Section -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseEvents"
                aria-expanded="false" aria-controls="collapseEvents">
                <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                Events
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseEvents" aria-labelledby="headingEvents"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('admin.events.index') }}">View Events</a>
                    <a class="nav-link" href="{{ route('admin.events.create') }}">Add Events</a>
                </nav>
            </div>

            {{-- <!-- Hotel Section -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseHotels"
                aria-expanded="false" aria-controls="collapseHotels">
                <div class="sb-nav-link-icon"><i class="fas fa-hotel"></i></div>
                Hotels
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a> --}}
            {{-- <div class="collapse" id="collapseHotels" aria-labelledby="headingHotels"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="">View Hotels</a>
                    <a class="nav-link" href="">Add Hotels</a>
                </nav>
            </div> --}}

            <!-- Separator -->
            <hr>

            <!-- Feedbacks -->
            <a class="nav-link" href="{{ route('admin.feedbacks.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                Feedbacks
            </a>

            <!-- Activity Logs Section -->
            <a class="nav-link" href="{{ route('admin.activity-logs.index') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                Activity Logs
            </a>



            <!-- Logout -->
            <a class="nav-link" href="#" onclick="document.getElementById('logout-form').submit();">
                <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    </div>
</nav>
