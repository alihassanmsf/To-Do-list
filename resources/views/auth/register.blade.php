@extends('layouts.app')

@section('content')
    <!-- ✅ Full Page Centering & Dark Mode Support -->
    <div class="min-h-screen flex items-center justify-center px-4 relative"
         :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'">

        <!-- ✅ Registration Card (Fixed Centering Issue) -->
        <div class="w-full max-w-md absolute  transform  rounded-3xl shadow-lg overflow-hidden transition-all duration-300 animate-fade-in"
             :class="darkMode ? 'bg-gray-800 text-white' : 'bg-white text-gray-900'">

            <!-- ✅ Card Header with Hover Effect -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-center py-6 transition duration-300 hover:scale-105">
                <h2 class="text-2xl font-bold text-white">Register</h2>
            </div>

            <!-- ✅ Card Body -->
            <div class="px-8 py-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- ✅ Name Input -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium mb-2">Name</label>
                        <input type="text" id="name" name="name"
                               required autocomplete="name"
                               :class="darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300 text-black'"
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all duration-300"
                               placeholder="Enter your name">
                    </div>

                    <!-- ✅ Email Input -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email"
                               required autocomplete="email"
                               :class="darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300 text-black'"
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all duration-300"
                               placeholder="Enter your email">
                    </div>

                    <!-- ✅ Password Input with Show/Hide Feature & Strength Indicator -->
                    <div class="mb-6 relative" x-data="{ showPassword: false, password: '', strength: '' }">
                        <label for="password" class="block text-sm font-medium mb-2">Password</label>
                        <input :type="showPassword ? 'text' : 'password'"
                               id="password" name="password"
                               x-model="password"
                               @input="strength = password.length > 8 ? 'Strong' : password.length > 4 ? 'Medium' : 'Weak'"
                               required autocomplete="new-password"
                               :class="darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300 text-black'"
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all duration-300"
                               placeholder="Enter your password">

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

                    <!-- ✅ Confirm Password Input -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium mb-2">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               required autocomplete="new-password"
                               :class="darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300 text-black'"
                               class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all duration-300"
                               placeholder="Confirm your password">
                    </div>

                    <!-- ✅ Submit Button with Animation -->
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform active:scale-95">
                        Register
                    </button>
                </form>

                <!-- ✅ Login Link -->
                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}"
                       class="text-sm font-semibold text-blue-600 hover:text-blue-500 underline">
                        Already have an account? Login here.
                    </a>
                </div>
            </div>
        </div>

    </div>
@endsection
