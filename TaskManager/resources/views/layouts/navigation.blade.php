<style>
    body {
        font-family: 'Poppins';
    }

    .sidebar {
        width: 250px;
        background-color: #3D8D7A;
        color: white;
        height: 100vh;
        position: fixed;
    }

    /* Navigation Buttons */
    .nav-btn {
        background: #A3D1C6;
        color: white;
        font-size: large;
        font-weight: bold;
        padding: 10px;
        text-align: left;
        border: none;
        display: flex;
        align-items: center;
        gap: 12px;
        /* Space between icon & text */
        transition: 0.3s;
    }

    .nav-btn:hover {
        background: #FBFFE4;
        color: #B3D8A8 !important;
    }

    .active-link {
        background: white;
        color: #3D8D7A !important;
        font-weight: bold;
    }


    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .content {
        flex-grow: 1;
        padding: 10px;
        margin-left: 250px;
    }

    .form-control {
        border-radius: 5px;
    }
</style>

<!-- Primary Navigation Menu -->
<div class="sidebar d-flex flex-column justify-content-between p-2" style="height: 100vh;">
    <div>
        <div class="mb-4 text-center">
            <h1 class="fs-4">Welcome, {{ Auth::user()->name }}</h1>
        </div>
        <hr class="mt-2 mb-4">
        <nav class="nav flex-column gap-2">
            @if(Auth::check())
            @if(Auth::user()->role === 'admin')
            <div>
                <a href="{{ route('admin.dashboard') }}"
                    class="btn nav-btn {{ request()->routeIs('admin.dashboard') ? 'active-link' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </div>
            <div>
                <a href="{{ route('admin.tasks') }}"
                    class="btn nav-btn {{ request()->routeIs('admin.tasks') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-list-check"></i> Task
                </a>
            </div>
            <div>
                <a href="{{ route('admin.tasks.create') }}"
                    class="btn nav-btn {{ request()->routeIs('admin.tasks.create') ? 'active-link' : '' }}">
                    <i class="fas fa-plus-circle"></i> Add Task
                </a>
            </div>

            @elseif(Auth::user()->role === 'manager')
            <div>
                <a href="{{ route('manager.dashboard') }}"
                    class="btn nav-btn {{ request()->routeIs('manager.dashboard') ? 'active-link' : '' }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </div>
            <div>
                <a href="{{ route('manager.tasks') }}"
                    class="btn nav-btn {{ request()->routeIs('manager.tasks') ? 'active-link' : '' }}">
                    <i class="fa-solid fa-list-check"></i> Task
                </a>
            </div>
            <div>
                <a href="#" class="btn nav-btn">
                    Setting
                </a>
            </div>

            @elseif(Auth::user()->role === 'employee')
            <div>
                <a href="{{ route('employee.dashboard') }}" class="btn nav-btn">Employee Dashboard</a>
            </div>
            <div>
                <a href="{{ route('employee.tasks') }}" class="btn nav-btn">My Tasks</a>
            </div>
            @endif
            @endif

        </nav>
    </div>
    <form method="POST" action="{{ route('logout') }}" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-danger w-100">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </form>
</div>

<!-- Top Header with Settings Dropdown Only -->
<div class="d-flex justify-content-end align-items-center p-3" style="margin-left: 250px;">
    <!-- Settings Dropdown (Bootstrap Dropdown) -->
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="settingsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-regular fa-user"></i>
        </button>
        <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
            <li class="dropdown-item-text"><strong>{{ Auth::user()->name }}</strong></li>
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</button>
                </form>
            </li>
        </ul>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@yield('content')