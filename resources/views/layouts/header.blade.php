<header class="w-full border-b bg-white dark:bg-gray-900 shadow-md transition-all">
    <nav class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold text-gray-800 dark:text-white">To-Do List</a>

        <!-- Navigation -->
        <div class="hidden md:flex space-x-4">
            <a href="/" class="text-gray-600 dark:text-gray-300 hover:text-blue-500">Home</a>
            <a href="/tasks" class="text-gray-600 dark:text-gray-300 hover:text-blue-500">Tasks</a>

            @auth
                @if(auth()->user()->role->name == 'Admin' || auth()->user()->role->name == 'Manager')
                    <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                        Create Task
                    </a>
                @endif
            @endauth
        </div>

        <!-- Theme Toggle -->
        <button @click="darkMode = !darkMode" class="ml-4 p-2 rounded-full transition bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white">
            <span x-show="darkMode">🌙</span>
            <span x-show="!darkMode">☀️</span>
        </button>

        <!-- User Menu -->
        @if(auth()->check())
            <div x-data="{ open: false }" class="relative ml-4">
                <button @click="open = !open" class="px-3 py-2 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white rounded-md">
                    {{ auth()->user()->name }}
                </button>
                <div x-show="open" class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 shadow-md rounded-md">
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="block w-full px-4 py-2 text-left text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">Logout</button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="ml-4 px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 transition">Login</a>
            <a href="{{ route('register') }}" class="ml-2 px-4 py-2 border border-green-500 text-green-500 rounded-md hover:bg-green-500 hover:text-white transition">Register</a>
        @endif
    </nav>
</header>
