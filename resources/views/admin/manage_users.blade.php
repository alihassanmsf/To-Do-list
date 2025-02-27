@extends('layouts.app')
@section('content')
    <div class="container mx-auto py-8 px-4" :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'">

        <!-- ✅ Success Alert -->
        @if (session()->has('message'))
            <div class="p-3 mb-4 rounded-lg bg-green-500 text-white shadow-lg">
                {{ session('message') }}
            </div>
        @endif

        <!-- ✅ Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Manage Users</h2>

            <div class="space-x-3">
                <a href="{{route(a)}}" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                    ➕ Create New User
                </a>
                <a href="{{ route('admin.dashboard') }}"
                   class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition">
                    ⬅ Return To Dashboard
                </a>
            </div>
        </div>

        <!-- ✅ Users Table -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead>
                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-sm">
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Role</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $usr)
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $usr->name }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $usr->email }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $usr->role ? ucfirst($usr->role->name) : 'N/A' }}</td>
                        <td class="px-6 py-4 text-right">
                            <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
                                    wire:click="editUser({{ $usr->id }})">
                                ✏ Edit
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- ✅ User Modal -->
        @if ($isModalOpen)
            <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl w-96 p-6 transition-all transform scale-95">

                    <!-- ✅ Modal Header -->
                    <div class="flex justify-between items-center mb-4">
                        <h5 class="text-xl font-semibold">
                            {{ $editMode ? 'Edit User' : 'Create User' }}
                        </h5>
                        <button class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
                                wire:click="closeModal">
                            ❌
                        </button>
                    </div>

                    <!-- ✅ Modal Body -->
                    <div class="space-y-4">
                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                            <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 transition"
                                   wire:model="name" required>
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <input type="email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 transition"
                                   wire:model="email" required>
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password -->
                        @if(!$editMode || $password)
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                                <input type="password" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 transition"
                                       wire:model="password">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                                <input type="password" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 transition"
                                       wire:model="password_confirmation">
                                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        @endif

                        <!-- Role -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                            <select class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 transition"
                                    wire:model="role_id">
                                <option value="">-- Select Role --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>
                            @error('role_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- ✅ Modal Footer -->
                    <div class="mt-4 flex justify-end space-x-3">
                        <button class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition"
                                wire:click="closeModal">
                            ❌ Close
                        </button>
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition"
                                wire:click="saveUser">
                            {{ $editMode ? 'Update' : 'Save' }}
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
