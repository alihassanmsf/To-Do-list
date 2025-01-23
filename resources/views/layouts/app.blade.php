<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Laravel App</title>
    <!-- Add your CSS files here -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
</head>
<body>
<!-- Header -->
<header>
    <nav>
        @if(auth()->check())
            @if(auth()->user()->role->name == 'Admin'|| auth()->user()->role->name =='Manager')
                <a href="{{route('tasks.create')}}" > Create Task</a>
            @endif
            <p>Welcome, {{auth()->user()->name}}</p>
        @endif
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/tasks">Tasks</a></li>
            @auth
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @else
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @endauth
        </ul>
    </nav>
</header>

<!-- Main Content -->
<main>
    <div class="container">
        @yield('content')
    </div>
</main>

<!-- Footer -->
<footer>
    <p>&copy; {{ date('Y') }} My Laravel App. All rights reserved.</p>
</footer>
</body>
</html>
