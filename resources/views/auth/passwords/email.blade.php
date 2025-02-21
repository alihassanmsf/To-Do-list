@extends('layouts.app')

@section('content')
    <!-- ✅ Background & Full Page Centering -->
    <div class="min-h-screen flex items-center justify-center px-4  relative"
         :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'">

        <!-- ✅ Password Reset Card (Now Properly Centered) -->
        <div class="w-full max-w-md absolute  transform -translate-y-1/1 rounded-3xl shadow-lg overflow-hidden transition-all duration-300 animate-fade-in"
             :class="darkMode ? 'bg-gray-800 text-white' : 'bg-white text-gray-900'">

            <!-- ✅ Card Header with Hover Effect -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-center py-6 transition duration-300 hover:scale-105">
                <h2 class="text-2xl font-bold text-white">{{ __('passwords.Reset Password') }}</h2>
            </div>

            <!-- ✅ Card Body -->
            <div class="px-8 py-8">

                <!-- ✅ Success Message (Auto-Hide) -->
                @if (session('status'))
                    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                         class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 transition-opacity duration-500 animate-fade-in">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- ✅ Reset Password Form -->
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- ✅ Email Input -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium mb-2">{{ __('passwords.E-Mail Address') }}</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                            :class="darkMode ? 'bg-gray-700 border-gray-600 text-white' : 'bg-white border-gray-300 text-black'"
                            class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all duration-300"
                            placeholder="Enter your email"
                        >
                        @error('email')
                        <span class="text-sm text-red-600 mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- ✅ Submit Button with Animation -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform active:scale-95">
                        {{ __('passwords.Send Password Reset Link') }}
                    </button>
                </form>
            </div>
        </div>

        <!-- ✅ Dark Mode Floating Button -->
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
    </div>
@endsection
