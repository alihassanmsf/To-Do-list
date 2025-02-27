@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4 transition-all duration-300"
         :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'">

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
                <a href="{{ route('admin.create-user') }}"
                   class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                    ➕ Create New User
                </a>
                <a href="{{ route('admin.dashboard') }}"
                   class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition">
                    ⬅ Return To Dashboard
                </a>
            </div>
        </div>

        <!-- ✅ Users Table -->
        <div class="shadow-md rounded-lg overflow-hidden transition-all duration-300"
             :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-900'">
            <table class="w-full border-collapse">
                <thead>
                <tr class="transition-all duration-300"
                    :class="darkMode ? 'bg-gray-700 text-gray-300' : 'bg-gray-100 text-gray-600'">
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-left">Role</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $usr)
                    <tr class="border-b transition-all duration-300"
                        :class="darkMode ? 'border-gray-700 hover:bg-gray-700' : 'border-gray-200 hover:bg-gray-50'">
                        <td class="px-6 py-4">{{ $usr->name }}</td>
                        <td class="px-6 py-4">{{ $usr->email }}</td>
                        <td class="px-6 py-4">{{ $usr->role ? ucfirst($usr->role->name) : 'N/A' }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.edit-user', $usr->id) }}"
                               class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                ✏ Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
