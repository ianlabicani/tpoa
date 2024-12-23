 <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
     <div class="container">
         <a class="navbar-brand" href="{{ route('/') }}">TPOA</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
             aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto">
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('about') }}">About</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('destinations.index') }}">Destinations</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('destinations.videos') }}">Videos</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('services') }}">Services</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                 </li>
                 <li class="nav-item">
                     @if (Auth::user())
                         @if (Auth::user()->role === 'admin')
                             <a class="btn btn-primary" href="{{ route('admin.dashboard') }}">Dashboard</a>
                         @else
                             <a class="btn btn-primary" href="{{ route('user.dashboard') }}">Dashboard</a>
                         @endif
                     @else
                         <a class="btn btn-primary" href="{{ route('register') }}">Get Started</a>
                     @endif
                 </li>
             </ul>
         </div>
     </div>
 </nav>
