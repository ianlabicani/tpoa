<style>
    @font-face {
       font-family: 'gugi';
       src: url('{{ asset('fonts/Gugi-Regular.ttf') }}') format('truetype');
       font-style: normal;
     
   }


   .navbar-brand{
       font-family: 'gugi'
   }
</style>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ url('admin/dashboard') }}">TPOA</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" method="GET" action="{{ route('search') }}">
        <div class="input-group">
            <input class="form-control" name="query" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" required />
            <button class="btn btn-primary" id="btnNavbarSearch" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              
                <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                <li><hr class="dropdown-divider" /></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="dropdown-item m-0 p-0">
                        @csrf
                        <button class="btn text-start w-100 logout-btn" type="submit">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
