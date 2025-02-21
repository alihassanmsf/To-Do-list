@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4" :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'">

        <!-- ✅ Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">User Profile</h2>
            <div class="space-x-3">
                @if (!$editMode)
                    <a href="{{ route('profile', ['edit' => true]) }}"
                       class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105">
                        ✏ Edit Profile
                    </a>
                @endif

                @if(auth()->user()->role->name === 'Admin')
                    <a href="{{ route('admin.dashboard') }}"
                       class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition duration-300 transform hover:scale-105">
                        ⬅ Return To Dashboard
                    </a>
                @elseif(auth()->user()->role->name === 'Manager')
                    <a href="{{ route('manager.dashboard') }}"
                       class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition duration-300 transform hover:scale-105">
                        ⬅ Return To Dashboard
                    </a>
                @endif
            </div>
        </div>

        <!-- ✅ Profile Card -->
        <div class="bg-white dark:bg-gray-800 bg-opacity-80 backdrop-blur-lg shadow-xl rounded-xl p-6 max-w-2xl mx-auto transition duration-300 hover:shadow-2xl">

            <!-- ✅ Success Alert -->
            @if (session('success'))
                <div class="p-3 mb-4 rounded-lg bg-green-500 text-white shadow-md animate-pulse">
                    {{ session('success') }}
                </div>
            @endif

            @if ($editMode)
                <!-- ✅ Edit Profile Form -->
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- ✅ Name Field -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" id="name" name="name"
                               class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition duration-300"
                               value="{{ $user->name }}" required>
                    </div>

                    <!-- ✅ Email Field -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" id="email" name="email"
                               class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition duration-300"
                               value="{{ $user->email }}" required>
                    </div>

                    <!-- ✅ Password Field -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            New Password (Leave blank to keep current password)
                        </label>
                        <input type="password" id="password" name="password"
                               class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition duration-300">
                    </div>

                    <!-- ✅ Confirm Password Field -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Confirm New Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition duration-300">
                    </div>

                    <!-- ✅ Buttons -->
                    <div class="flex justify-between">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105">
                            ✅ Update Profile
                        </button>
                        <a href="{{ route('profile') }}"
                           class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-300 transform hover:scale-105">
                            ❌ Cancel
                        </a>
                    </div>
                </form>
            @else
                <!-- ✅ Display Profile Details -->
                <div class="text-lg space-y-3">
                    <p><strong class="text-blue-500">Name:</strong> {{ $user->name }}</p>
                    <p><strong class="text-blue-500">Email:</strong> {{ $user->email }}</p>
                    <p><strong class="text-blue-500">Role:</strong> {{ ucfirst($user->role->name) }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
