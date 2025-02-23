<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40 !important;
        }

        .nav-link {
            background-color: #6a11cb;
            color: white !important;
            border-radius: 5px;
        }

        .hero-section {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">TaskManager</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                @if (Route::has('login'))
                <ul class="navbar-nav">
                    @auth
                    @if(auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link btn btn-light text-dark px-3" href="{{ route('admin.dashboard') }}">
                            Admin Dashboard
                        </a>
                    </li>
                    @elseif(auth()->user()->role === 'manager')
                    <li class="nav-item">
                        <a class="nav-link btn btn-light text-dark px-3" href="{{ route('manager.dashboard') }}">
                            Manager Dashboard
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link btn btn-light text-dark px-3" href="{{ route('employee.dashboard') }}">
                            Employee Dashboard
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-danger text-white px-3 ms-2">
                                Logout
                            </button>
                        </form>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link btn btn-light text-dark px-3" href="{{ route('login') }}">Log in</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link btn btn-light text-dark px-3 ms-2" href="{{ route('register') }}">
                            Register
                        </a>
                    </li>
                    @endif
                    @endauth
                </ul>
                @endif
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-1 fw-bold">Effortless manage your tasks</h1>
            <p class="lead">Stay organized, boost productivity, and streamline your workflow with our intuitive task management system.</p>
            @guest
            <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4 mt-3">Get Started</a>
            @endguest
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>