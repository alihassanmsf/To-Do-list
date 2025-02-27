@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4 transition-all duration-300"
         :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'">

        <!-- ✅ Success Message -->
        @if (session()->has('message'))
            <div class="p-3 mb-4 rounded-lg bg-green-500 text-white shadow-lg">
                {{ session('message') }}
            </div>
        @endif

        <!-- ✅ Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Task Management</h2>
            <div class="space-x-3">
                <a href="{{ route('tasks.create') }}"
                   class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-300 transform hover:scale-105">
                    ➕ Create Task
                </a>

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

        <!-- ✅ Styled Table -->
        <div class="shadow-md rounded-lg overflow-hidden transition-all duration-300"
             :class="darkMode ? 'bg-gray-800 text-gray-200' : 'bg-white text-gray-900'">
            <table class="w-full border-collapse">
                <thead>
                <tr class="transition-all duration-300"
                    :class="darkMode ? 'bg-gray-700 text-gray-300' : 'bg-gray-200 text-gray-900'">
                    <th class="px-6 py-3 text-left">Task</th>
                    <th class="px-6 py-3 text-left">Assigned</th>
                    <th class="px-6 py-3 text-left">Due Date</th>
                    <th class="px-6 py-3 text-left">Priority</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr class="border-b transition-all duration-300"
                        :class="darkMode ? 'border-gray-700 hover:bg-gray-700' : 'border-gray-200 hover:bg-gray-50'">
                        <td class="px-6 py-4 font-semibold">{{ $task->name }}</td>
                        <td class="px-6 py-4">{{ $task->assignedUser ? $task->assignedUser->name : 'None' }}</td>
                        <td class="px-6 py-4">{{ date('d M Y', strtotime($task->due_date)) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-sm font-semibold rounded-full transition-all duration-300"
                                  :class="{
                                    'bg-red-500 text-white': '{{ $task->priority }}' === 'high',
                                    'bg-yellow-500 text-white': '{{ $task->priority }}' === 'medium',
                                    'bg-green-500 text-white': '{{ $task->priority }}' === 'low'
                                  }">
                                {{ ucfirst($task->priority) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-sm font-semibold rounded-full transition-all duration-300"
                                  :class="{
                                    'bg-red-500 text-white': '{{ $task->status }}' === 'pending',
                                    'bg-yellow-500 text-white': '{{ $task->status }}' === 'in_progress',
                                    'bg-green-500 text-white': '{{ $task->status }}' === 'completed'
                                  }">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right mr-2">
                            <a href="{{ route('tasks.edit', $task->id) }}"
                               class="px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105">
                                ✏ Edit
                            </a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 ml-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-300 transform hover:scale-105"
                                        onclick="return confirm('Are you sure you want to delete this task?')">
                                    ❌ Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
