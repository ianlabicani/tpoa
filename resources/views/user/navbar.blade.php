<Style>
    @font-face {
        font-family: 'barabara';
        src: url('{{ asset('fonts/BARABARA-final.otf') }}') format('truetype');
        font-style: normal;
        font-weight: thin
    }

    .navbar-brand {
        font-family: 'barabara';
        font-weight: 100
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
        <a class="navbar-brand text-dark" href="{{ route('user.dashboard') }}">
            <h1 class="m-0">TPOA</h1>
        </a>
        <!-- Toggler for smaller screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.dashboard') }}">Home</a>
                </li>
                <!-- About Aparri Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        aria-expanded="false">
                        About Aparri
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('user.history') }}">History</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.culture') }}">Culture</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.events') }}">Events</a></li>


                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.destinations.index') }}">Destinations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('destinations.videos') }}">Videos</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('/') }}#accomodations">Accomodations</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="mb-2">
                        @csrf
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<Style>
    @font-face {
        font-family: 'barabara';
        src: url('{{ asset('fonts/BARABARA-final.otf') }}') format('truetype');
        font-style: normal;
        font-weight: thin
    }

    .navbar-brand {
        font-family: 'barabara';
        font-weight: 100
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
