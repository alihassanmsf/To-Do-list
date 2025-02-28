<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Laravel App</title>

    @vite('resources/css/app.css') @livewireStyles
</head>
<body x-data="{ darkMode: localStorage.getItem('dark') === 'true' }"
      :class="{ 'dark bg-gray-900 text-gray-100': darkMode, 'bg-gray-50 text-gray-900': !darkMode }"
      class="flex flex-col min-h-screen transition-colors duration-300">

<!-- 🌟 Floating Dark Mode Toggle Button -->
<button @click="darkMode = !darkMode; localStorage.setItem('dark', darkMode)"
        class="fixed bottom-5 right-5 bg-gray-200 dark:bg-gray-700 p-3 rounded-full shadow-md transition-all hover:bg-gray-300 dark:hover:bg-gray-600">
    <svg x-show="!darkMode" class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none"
         stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 3v1m0 16v1m-8-8H3m16 0h1M5.64 5.64l-.71-.71m12.02 12.02l-.71-.71M5.64 18.36l-.71.71m12.02-12.02l-.71.71"/>
    </svg>
    <svg x-show="darkMode" class="w-6 h-6 text-gray-700 dark:text-gray-300" fill="none"
         stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 3v1m0 16v1m-8-8H3m16 0h1M5.64 5.64l-.71-.71m12.02 12.02l-.71-.71M5.64 18.36l-.71.71m12.02-12.02l-.71.71"/>
    </svg>
</button>
<!-- ✅ Header Section -->
<header :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-900'"
        class="shadow-md transition-colors duration-300">
    <nav class="container mx-auto px-4 py-4 flex justify-between items-center">

        <!-- ✅ Logo -->
        <a href="/" class="text-2xl font-bold text-blue-600 dark:text-blue-400 hover:scale-105 transition">
            My Laravel App
        </a>

        <!-- ✅ Navigation Links -->
        <div class="hidden md:flex items-center space-x-6">
            @if(auth()->user()->role === 'User')
            <a href="/" class="hover:text-blue-600 transition">Home</a>
            <a href="/tasks" class="hover:text-blue-600 transition">Tasks</a>
            @endif
        </div>
        <div x-data="{ profileOpen: false }" class="relative">

            @auth  <!-- ✅ Only show if user is authenticated -->
            <button @click="profileOpen = !profileOpen"
                    class="flex items-center space-x-2 focus:outline-none hover:scale-105 transition">

                <!-- ✅ User Initials (Fix for Guest Users) -->
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white text-lg font-bold">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>

                <span class="hidden md:block text-sm font-medium">{{ auth()->user()->name }}</span>

                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <!-- ✅ Profile Dropdown Menu -->
            <div x-show="profileOpen" @click.away="profileOpen = false"
                 :class="darkMode ? 'bg-gray-900 text-gray-200' : 'bg-white text-gray-900'"
                 class="absolute right-0 mt-2 w-48 shadow-lg rounded-md py-2 z-10 transition-all duration-300">

                <a href="/profile"
                   class="block px-4 py-2 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-md transition">
                    👤 Profile
                </a>

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-700 transition">
                        🚪 Logout
                    </button>
                </form>
            </div>
            @endauth

            @guest  <!-- ✅ If user is not logged in, show login/register buttons -->
            <div class="space-x-3">
                <a href="{{ route('login') }}"
                   class="px-4 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-700 rounded-full hover:bg-gray-400 transition">
                    Register
                </a>
            </div>
            @endguest

        </div>


        <!-- ✅ Mobile Menu Button -->
        <div x-data="{ mobileOpen: false }" class="md:hidden">
            <button @click="mobileOpen = !mobileOpen" class="p-2 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
            </button>

            <!-- ✅ Mobile Dropdown Menu -->
            <div x-show="mobileOpen" @click.away="mobileOpen = false"
                 :class="darkMode ? 'bg-gray-900 text-gray-200' : 'bg-white text-gray-900'"
                 class="absolute top-14 left-0 w-full shadow-md rounded-md p-4 transition-all duration-300">
                <a href="/" class="block py-2 hover:text-blue-600">Home</a>
                <a href="/tasks" class="block py-2 hover:text-blue-600">Tasks</a>
            </div>
        </div>
    </nav>
</header>


<!-- ✅ Explanation:
- A beautiful, responsive navbar with animated hover effects.
- Mobile menu is powered by Alpine.js for smooth transitions.
-->

<!-- ✅ Main Content -->
<main class="flex-grow container mx-auto px-4 py-8">
    @yield('content')
</main>

<!-- ✅ Footer -->
<footer :class="darkMode ? 'bg-gray-800 text-gray-300' : 'bg-white text-gray-600'"
        class="shadow-md mt-auto py-4 transition-colors duration-300">
    <div class="container mx-auto px-4 text-center text-sm">
        &copy; {{ date('Y') }} My Laravel App. All rights reserved.
    </div>
</footer>

@livewireScripts @vite('resources/js/app.js')

</body>
</html>
