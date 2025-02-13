<style>
    @font-face {
        font-family: 'gugi';
        src: url('{{ asset('fonts/Gugi-Regular.ttf') }}') format('truetype');
        font-style: normal;
    }

    .navbar-brand {
        font-family: 'gugi';
        font-weight: 200;
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
        background-color: #fff;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<nav class="navbar navbar-expand-lg bg-white shadow p-3">
    <div class="container">
        <a class="navbar-brand text-dark" href="{{ route('user.dashboard') }}">
            <h1 class="m-0">QuickEnroll</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
<<<<<<< HEAD
                <!-- Enroll Dropdown -->
=======
>>>>>>> d8040f8 (feb 13)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" aria-expanded="false">
                        Enrollment            
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
<<<<<<< HEAD
                        <li><a class="dropdown-item" href="{{ route('user.students.create') }}">enroll</a></li>
=======
                        <li><a class="dropdown-item" href="{{ route('user.history') }}">History</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.culture') }}">Culture</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.events') }}">Events</a></li>
                        <li><a class="dropdown-item" href="{{ route('products') }}">Products</a></li>
>>>>>>> d8040f8 (feb 13)
                    </ul>
                </li>

                <!-- Contact Link -->
                <li class="nav-item">
<<<<<<< HEAD
                    <a class="nav-link" href="#">Contact</a>
                </li>

                <!-- User Dropdown (Logged In) -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <!-- Display logged-in user's name -->
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                         
=======
                    <a class="nav-link" href="{{ route('user.destinations.index') }}">Destinations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.hotels.index') }}">Hotels</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.destinations.videos') }}">Videos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.contact') }}">Contact</a>
                </li>

                <!-- Logged-in User Dropdown -->
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                             {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        
>>>>>>> d8040f8 (feb 13)
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="mb-2">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endauth
<<<<<<< HEAD

                <!-- Guest Link (Logout for non-authenticated users) -->
                @guest
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="mb-2">
                            @csrf
                            <button class="btn btn-primary" type="submit">Logout</button>
                        </form>
                    </li>
                @endguest
=======
>>>>>>> d8040f8 (feb 13)
            </ul>
        </div>
    </div>
</nav>

