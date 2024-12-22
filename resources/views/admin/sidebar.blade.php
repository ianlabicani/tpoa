<nav class="bg-dark text-white p-4">
    <h1>TPOA</h1>
    <a class="btn btn-primary d-block mb-2" href="{{ route('admin.dashboard', []) }}" role="button">Dashboard</a>
    <a class="btn btn-primary d-block mb-2" href="{{ route('admin.destinations.index') }}" role="button">Destinations</a>
    <a class="btn btn-primary d-block mb-2" href="{{ route('admin.destinations.create') }}" role="button">Add
        Destination</a>

    <form action="{{ route('logout') }} " method="POST">
        @csrf
        <button class="btn btn-primary d-block mb-2" type="submit">Logout</button>
    </form>

</nav>
