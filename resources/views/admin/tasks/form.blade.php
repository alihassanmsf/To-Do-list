@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

        <!-- ✅ Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">
                {{ isset($task) ? 'Edit Task' : 'Create Task' }}
            </h2>
            <a href="{{ route('tasks.index') }}"
               class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition">
                ⬅ Return To Tasks
            </a>
        </div>

        <!-- ✅ Task Form -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <form method="POST" action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}">
                @csrf
                @if(isset($task))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Task Name</label>
                    <input type="text" name="name" value="{{ old('name', $task->name ?? '') }}"
                           class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description"
                              class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">{{ old('description', $task->description ?? '') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                    <input type="date" name="due_date" value="{{ old('due_date', $task->due_date ?? '') }}"
                           class="w-full px-4 py-2 border rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        {{ isset($task) ? 'Update Task' : 'Create Task' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
