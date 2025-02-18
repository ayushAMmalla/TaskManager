<ul class="navbar-nav">
    @if(Auth::check())
        @if(Auth::user()->hasRole('Admin'))
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
        @elseif(Auth::user()->hasRole('manager'))
            <li class="nav-item"><a class="nav-link" href="{{ route('manager.dashboard') }}">Manager Dashboard</a></li>
        @elseif(Auth::user()->hasRole('employee'))
            <li class="nav-item"><a class="nav-link" href="{{ route('employee.dashboard') }}">Employee Dashboard</a></li>
        @endif

        @yield('content')

        
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="nav-link btn btn-link">Logout</button>
            </form>
        </li>
    @endif
</ul>
