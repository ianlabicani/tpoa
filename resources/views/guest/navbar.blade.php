<Style>
    @font-face {
        font-family: 'gugi';
        src: url('{{ asset('fonts/Gugi-Regular.ttf') }}') format('truetype');
        font-style: normal;

    }


    .navbar-brand {
        font-family: 'gugi';
        font-weight: 200
    }

    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-menu {
        display: none;
    }

    .navbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        /* Make sure it sits on top of other content */
        background-color: #fff;
        /* or any background color */
    }
</Style>

<nav class="navbar navbar-expand-lg bg-white shadow p-3">
    <div class="container">
        <a class="navbar-brand text-dark" href="/">
            <h1 class="m-0">QuickEnroll</h1>
        </a>

        <!-- Toggler for smaller screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">


                <div class="collapse navbar-collapse" id="navbarNav">
<<<<<<< HEAD
                
                   
                    <li class="nav-item">
                        <a class="nav-link" href="">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="">About us</a>
                    </li>
                    <li class="nav-item">
                        @if (Auth::user())
                            @if (Auth::user()->role === 'admin')
                                <a class="btn btn-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            @elseif (Auth::user()->role === 'hotel-owner')
                                <a class="btn btn-primary" href="{{ route('hotel-owner.dashboard') }}">Dashboard</a>
=======
                    <ul class="navbar-nav ms-auto">
                        <!-- About Aparri Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                aria-expanded="false">
                                About Aparri
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{ route('history') }}">History</a></li>
                                <li><a class="dropdown-item" href="{{ route('culture') }}">Culture</a></li>
                                <li><a class="dropdown-item" href="{{ route('guest.events') }}">Events</a></li>
                                <li><a class="dropdown-item" href="{{ route('products') }}">Products</a></li>
                            </ul>
                        </li>
                        <!-- Other Navbar Items -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('destinations.index') }}">Destinations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('hotels.index') }}">Hotels</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('destinations.videos') }}">Videos</a>
                        </li>
                 
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                        </li>
                        <li class="nav-item">
                            @if (Auth::user())
                                @if (Auth::user()->role === 'admin')
                                    <a class="btn btn-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                @elseif (Auth::user()->role === 'hotel-owner')
                                    <a class="btn btn-primary"
                                        href="{{ route('hotel-owner.dashboard') }}">Dashboard</a>
                                @else
                                    <a class="btn btn-primary" href="{{ route('user.dashboard') }}">Dashboard</a>
                                @endif
>>>>>>> d8040f8 (feb 13)
                            @else
                                <a class="btn btn-primary" href="{{ route('user.dashboard') }}">Dashboard</a>
                            @endif
                        @else
                            <a class="btn btn-primary" href="{{ route('login') }}">Get Started</a>
                        @endif
                    </li>
            </ul>
        </div>

        </ul>

    </div>

    </div>
</nav>
