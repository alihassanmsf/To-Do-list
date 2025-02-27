@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4 transition-all duration-300"
         :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'">

        <!-- ✅ Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">
                {{ isset($user) ? 'Edit User' : 'Create New User' }}
            </h2>

            <a href="{{ route('admin.users.list') }}"
               class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition">
                ⬅ Return To Users
            </a>
        </div>

        <!-- ✅ User Form -->
        <div class="shadow-md rounded-lg p-6 transition-all duration-300"
             :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-900'">
            <form method="POST" action="{{ isset($user) ? route('admin.update-user', $user->id) : route('admin.store-user') }}">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
                               class="w-full px-4 py-2 border rounded-lg transition-all duration-300"
                               :class="darkMode ? 'bg-gray-700 text-white border-gray-600 focus:ring-blue-400' : 'bg-gray-100 text-gray-900 border-gray-300 focus:ring-blue-500'"  required>
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}"
                               class="w-full px-4 py-2 border rounded-lg transition-all duration-300"
                               :class="darkMode ? 'bg-gray-700 text-white border-gray-600 focus:ring-blue-400' : 'bg-gray-100 text-gray-900 border-gray-300 focus:ring-blue-500'" required>
                        @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Password (Only for create) -->
                @if(!isset($user))
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium">Password</label>
                            <input type="password" name="password"
                                   class="w-full px-4 py-2 border rounded-lg transition-all duration-300"
                                   :class="darkMode ? 'bg-gray-700 text-white border-gray-600 focus:ring-blue-400' : 'bg-gray-100 text-gray-900 border-gray-300 focus:ring-blue-500'">
                            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                   class="w-full px-4 py-2 border rounded-lg transition-all duration-300"
                                   :class="darkMode ? 'bg-gray-700 text-white border-gray-600 focus:ring-blue-400' : 'bg-gray-100 text-gray-900 border-gray-300 focus:ring-blue-500'">
                        </div>
                    </div>
                @endif

                <!-- Role -->
                <div class="mb-4">
                    <label class="block text-sm font-medium">Role</label>
                    <select name="role_id"
                            class="w-full px-4 py-2 border rounded-lg transition-all duration-300"
                            :class="darkMode ? 'bg-gray-700 text-white border-gray-600 focus:ring-blue-400' : 'bg-gray-100 text-gray-900 border-gray-300 focus:ring-blue-500'">
                        <option value="">-- Select Role --</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ isset($user) && $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-6 flex justify-end">
                    <button type="submit"
                            class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105">
                        {{ isset($user) ? 'Update User' : 'Create User' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
