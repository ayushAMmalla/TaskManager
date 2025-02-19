
<style>
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
        /* Soft Peach */
        color: #B3D8A8 !important;
    }

    .active-link {
        background: white;
        color: #B3D8A8 !important;
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
</style>

<!-- Primary Navigation Menu -->
<div class="sidebar d-flex flex-column justify-content-between p-2" style="height: 100vh;">
    <div>
        <div class="mb-4 text-center">
            <h1 class="fs-4">Welcome, {{ Auth::user()->name }}</h1>
        </div>
        <hr>

        <nav class="nav flex-column gap-2">
            @if(Auth::check())
            @if(Auth::user()->hasRole('Admin'))
            <div>
                <a href="{{ route('admin.dashboard') }}" class="btn nav-btn mt-2">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </div>
            <div>
                <a href="{{ route('admin.tasks') }}" class="btn nav-btn">
                    Manage Task
                </a>
            </div>
            <div>
                <a href="#" class="btn nav-btn">
                    Setting
                </a>
            </div>
            @elseif(Auth::user()->hasRole('Manager'))
            <div>
                <a href="{{ route('manager.dashboard') }}" class="btn nav-btn">Manager Dashboard</a>
            </div>
            <div>
                <a href="{{ route('manager.tasks') }}" class="btn nav-btn">Team Tasks</a>
            </div>
            <div>
                <a href="#" class="btn nav-btn">
                    Setting
                </a>
            </div>
            @endif
            @elseif(Auth::user()->hasRole('Employee'))
            <div>
                <a href="{{ route('employee.dashboard') }}" class="btn nav-btn">Employee Dashboard</a>
            </div>
            <div>
                <a href="{{ rroute('employee.tasks') }}" class="btn nav-btn">My Tasks</a>
            </div>
            <div>
                <a href="#" class="btn nav-btn">
                    Setting
                </a>
            </div>
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
        {{ Auth::user()->name }}
        </button>
        <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</button>
                </form>
            </li>
        </ul>
    </div>
</div>
<!-- Bootstrap JS (Place this just before closing </body> tag) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<hr>
@yield('content')