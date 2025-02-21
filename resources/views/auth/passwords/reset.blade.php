@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 flex items-center justify-center py-8">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-lg overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-center py-6">
                <h2 class="text-2xl font-bold text-white">{{ __('passwords.Reset Password') }}</h2>
            </div>

            <!-- Card Body -->
            <div class="px-6 py-8">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <!-- Hidden Token Field -->
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Email Input -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('E-Mail Address') }}</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            value="{{ $email ?? old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                        >
                        @error('email')
                        <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">{{ __('passwords.Password') }}</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            required
                            autocomplete="new-password"
                        >
                        @error('password')
                        <span class="text-sm text-red-600 mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="mb-6">
                        <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-1">{{ __('passwords.Confirm Password') }}</label>
                        <input
                            type="password"
                            id="password-confirm"
                            name="password_confirmation"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                            required
                            autocomplete="new-password"
                        >
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all"
                    >
                        {{ __('passwords.Reset Password') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
