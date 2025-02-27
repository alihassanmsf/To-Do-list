@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen px-4 transition-all duration-300"
         :class="darkMode ? 'bg-gray-900 text-gray-100' : 'bg-gray-50 text-gray-900'">

        <div class="w-full max-w-2xl mx-auto relative rounded-3xl shadow-2xl p-12 transition-all duration-300 backdrop-blur-xl"
             :class="darkMode ? 'bg-gray-800' : 'bg-white'">

            <!-- ✅ Enhanced Header -->
            <div class="relative bg-opacity-80 px-10 py-6 rounded-t-3xl shadow-md flex justify-center transition-all duration-300"
                 :class="darkMode ? 'bg-gradient-to-br from-indigo-800 to-purple-900 text-white' : 'bg-gradient-to-r from-blue-500 to-purple-600 text-white'">
                <h1 class="text-3xl font-extrabold tracking-wide uppercase">
                    {{ isset($task) ? 'Edit Task' : 'Create Task' }}
                </h1>
            </div>

            <!-- ✅ Task Form -->
            <div class="px-8 py-10">
                <form action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
                    @csrf
                    @if(isset($task))
                        @method('PUT')
                    @endif

                    <div class="space-y-8">
                        <!-- Task Name -->
                        <div class="relative">
                            <input type="text" name="name" id="name" required
                                   value="{{ isset($task) ? $task->name : old('name') }}"
                                   class="w-full px-4 pt-5 pb-2 peer border rounded-lg focus:ring-2 focus:ring-blue-500 transition-all
                                          bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600
                                          focus:border-blue-500 dark:focus:border-indigo-400">
                            <label for="name"
                                   class="absolute left-4 top-2 text-gray-500 text-sm transition-all
                                          peer-placeholder-shown:top-5 peer-placeholder-shown:text-lg peer-placeholder-shown:text-gray-400
                                          peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                                Task Name
                            </label>
                        </div>

                        <!-- Description -->
                        <div class="relative">
                            <textarea name="description" id="description" rows="4" required
                                      class="w-full px-4 pt-5 pb-2 peer border rounded-lg focus:ring-2 focus:ring-blue-500 transition-all
                                             bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600
                                             focus:border-blue-500 dark:focus:border-indigo-400">
                                {{ isset($task) ? $task->description : old('description') }}
                            </textarea>
                            <label for="description"
                                   class="absolute left-4 top-2 text-gray-500 text-sm transition-all
                                          peer-placeholder-shown:top-5 peer-placeholder-shown:text-lg peer-placeholder-shown:text-gray-400
                                          peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                                Description
                            </label>
                        </div>

                        <!-- Due Date -->
                        <div class="relative">
                            <input type="date" name="due_date" id="due_date" required
                                   value="{{ isset($task) ? $task->due_date : old('due_date') }}"
                                   class="w-full px-4 pt-5 pb-2 peer border rounded-lg focus:ring-2 focus:ring-blue-500 transition-all
                                          bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600
                                          focus:border-blue-500 dark:focus:border-indigo-400">
                            <label for="due_date"
                                   class="absolute left-4 top-2 text-gray-500 text-sm transition-all
                                          peer-placeholder-shown:top-5 peer-placeholder-shown:text-lg peer-placeholder-shown:text-gray-400
                                          peer-focus:top-2 peer-focus:text-xs peer-focus:text-blue-500">
                                Due Date
                            </label>
                        </div>

                        <!-- Assigned For -->
                        <div class="relative">
                            <select name="assigned_for" id="assigned_for" required
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 transition-all
                                           bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600">
                                @forelse($users as $user)
                                    <option value="{{ $user->id }}" {{ (isset($task) && $task->assigned_for == $user->id) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @empty
                                    <option disabled>No users found</option>
                                @endforelse
                            </select>
                        </div>

                        <!-- Priority -->
                        <div class="relative">
                            <select name="priority" id="priority" required
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 transition-all
                                           bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600">
                                <option value="low" {{ (isset($task) && $task->priority == 'low') ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ (isset($task) && $task->priority == 'medium') ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ (isset($task) && $task->priority == 'high') ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <!-- Status -->
                        <div class="relative">
                            <select name="status" id="status" required
                                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 transition-all
                                           bg-gray-100 text-gray-900 dark:bg-gray-700 dark:text-white border-gray-300 dark:border-gray-600">
                                <option value="pending" {{ (isset($task) && $task->status == 'pending') ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ (isset($task) && $task->status == 'in_progress') ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ (isset($task) && $task->status == 'completed') ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 flex justify-center">
                        <button type="submit"
                                class="px-6 py-3 font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg
                                       bg-gradient-to-r from-blue-600 to-purple-500 text-white hover:from-blue-500 hover:to-purple-400
                                       dark:from-indigo-700 dark:to-purple-800 dark:hover:from-indigo-600 dark:hover:to-purple-700">
                            {{ isset($task) ? 'Update Task' : 'Create Task' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
