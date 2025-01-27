<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Laravel App</title>
    <!-- Include Vite for CSS and JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<!-- Header -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">My Laravel App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tasks">Tasks</a>
                    </li>
                    @auth
                        @if(auth()->user()->role->name == 'Admin' || auth()->user()->role->name == 'Manager')
                            <li class="nav-item">
                                <a class="btn btn-info" href="{{ route('tasks.create') }}">Create Task</a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <!-- Search Form -->
                @auth
                    <form class="d-flex me-3" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search tasks..." aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                @endauth

                <!-- Authentication Links -->
                @if(auth()->check())
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item ">
                                    @csrf
                                    <button type="submit" class="btn btn-danger  text-start">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary mx-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
                @endif
            </div>
        </div>
    </nav>
</header>

<!-- Main Content -->
<main class="py-4">
    <div class="container">
        @yield('content')
    </div>
</main>

<!-- Footer -->
<footer class="bg-light text-center py-3 mt-auto">
    <p class="mb-0">&copy; {{ date('Y') }} My Laravel App. All rights reserved.</p>
</footer>

</body>
</html>
