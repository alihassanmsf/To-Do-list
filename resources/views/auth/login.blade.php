@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- ✅ Success Message (Auto-Hide) -->
        @if (session()->has('email'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                 class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 transition-opacity duration-500 animate-fade-in">
                {{ session('email') }}
            </div>
        @endif

        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <!-- ✅ Card Container with Animation -->
                <div :class="darkMode ? 'bg-gray-800 text-white' : 'bg-white text-gray-900'"
                     class="rounded-3xl shadow-lg overflow-hidden border-0 transition-colors duration-300 animate-scale-in">

                    <!-- ✅ Card Header with Animation -->
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-center py-6 transform transition duration-300 hover:scale-105">
                        <h1 class="text-2xl font-bold text-white">Login</h1>
                    </div>

                    <!-- ✅ Card Body -->
                    <div class="px-6 py-8">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- ✅ Email Input -->
                            <div class="mb-6">
                                <label for="email" class="block text-sm font-medium mb-1">Email</label>
                                <input type="email" name="email" id="email"
                                       :class="darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300 text-black'"
                                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors duration-300"
                                       placeholder="Enter your email"
                                       required>
                            </div>

                            <!-- ✅ Password Input with Show/Hide Feature & Strength Indicator -->
                            <div class="mb-6 relative" x-data="{ showPassword: false, password: '', strength: '' }">
                                <label for="password" class="block text-sm font-medium mb-1">Password</label>
                                <input :type="showPassword ? 'text' : 'password'"
                                       name="password"
                                       id="password"
                                       x-model="password"
                                       @input="strength = password.length > 8 ? 'Strong' : password.length > 4 ? 'Medium' : 'Weak'"
                                       :class="darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300 text-black'"
                                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors duration-300"
                                       placeholder="Enter your password"
                                       required>

                                <!-- Show/Hide Button -->
                                <button type="button" @click="showPassword = !showPassword"
                                        class="absolute right-3 top-3 text-gray-500 dark:text-gray-300">
                                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15.232 15.232a6 6 0 0 1-8.464-8.464m.828 10.606a9 9 0 0 1-12.728-12.728m17.928 17.928a9 9 0 0 1-12.728-12.728M12 12l3 3m0 0l-3-3m3 3l-3-3"></path>
                                    </svg>
                                    <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12m-3-3a3 3 0 1 0 6 0 3 3 0 1 0-6 0zm9 0a9 9 0 0 1-12.728 12.728M9 9m-3 3a3 3 0 1 0 6 0 3 3 0 1 0-6 0"></path>
                                    </svg>
                                </button>

                                <!-- ✅ Password Strength Indicator -->
                                <p x-text="strength"
                                   :class="strength === 'Strong' ? 'text-green-500' : strength === 'Medium' ? 'text-yellow-500' : 'text-red-500'"
                                   class="text-sm mt-1">
                                </p>
                            </div>

                            <!-- ✅ Submit Button -->
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform active:scale-95">
                                Login
                            </button>

                            <!-- ✅ Forgot Password Link -->
                            <div class="mt-4 text-center">
                                <a href="{{ route('password.request') }}"
                                   :class="darkMode ? 'text-gray-400 hover:text-gray-100' : 'text-gray-600 hover:text-gray-900'"
                                   class="text-sm underline transition duration-200">
                                    Forgot your password? Reset it here.
                                </a>
                            </div>

                            <!-- ✅ Register Link -->
                            <div class="mt-4 text-center">
                                <a href="{{ route('register') }}"
                                   :class="darkMode ? 'text-blue-400 hover:text-blue-300' : 'text-blue-600 hover:text-blue-500'"
                                   class="text-sm font-semibold underline transition duration-200">
                                    Or register if you don't have an account
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
